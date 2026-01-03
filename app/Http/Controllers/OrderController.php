<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Services\BaseService;
use App\Http\Services\FormWizardService;
use App\Http\Services\OrderService;
use App\Models\Order;
use App\Models\Therapist;
use App\Notifications\TherapistOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Menmapilkan halaman data order
     *
     * @return void
     */
    public function index()
    {
        return view('admin.order.index', [
            'therapists' => Therapist::all(),
            'referrers' => OrderService::getAllReferrer()
        ]);
    }

    /**
     * Menampilkan halaman edit order
     *
     * @param  App\Model\Order $order
     * @return void
     */
    public function edit(Order $order)
    {
        return view('admin.order.edit', compact('order'));
    }

    /**
     * Update data order
     *
     * @param  App\Model\Order $order
     * @param  App\Http\Requests\OrderRequest $request
     * @return Illuminate\Http\Response
     */
    public function update(Order $order, OrderRequest $request)
    {
        try {
            $buyer_payment_method = $order->buyer_payment_method;
            $payment_status = $order->payment_status;

            $order->update($request->validated());

            $this->setReferrerFee($order);

            $this->sendEmailOrder($buyer_payment_method, $payment_status, $order);

            return response()->json(['message' => 'Data berhasil diupdate.'], 200);
        } catch (\Throwable $th) {
            // return response()->json(['message' => $th->getMessage()], 500);
            return response()->json(['message' => 'Data gagal diupdate.'], 500);
        }
    }

    /**
     * Mengatur bayaran referrer
     */
    protected function setReferrerFee(Order $order)
    {
        if ($order->order_status === "Selesai" && $order->payment_status === "Sudah Dibayar") {
            foreach ($order->orderItems as $orderItem) {
                $orderItem->update([
                    'referrer_fee' => FormWizardService::getreRerrerFee($orderItem->rate, $order->referrer_id)
                ]);
            }
        } else {
            foreach ($order->orderItems as $orderItem) {
                $orderItem->update([
                    'referrer_fee' => null
                ]);
            }
        }
    }

    /**
     * Mengirim email order notifikasi ke terapis
     *
     * @param  string $buyer_payment_method
     * @param  string $payment_status
     * @param  App\Model\Order $order
     * @return void
     */
    protected function sendEmailOrder($buyer_payment_method, $payment_status, Order $order)
    {
        if ($buyer_payment_method === "Transfer" && $payment_status === "Belum Dibayar" && $order->payment_status === "Sudah Dibayar") {
            Mail::to($order->therapist->email)->send(new TherapistOrderNotification($order));
        }
    }

    /**
     * Menghapus order
     *
     * @param  App\Model\Order $order
     * @return void
     */
    public function destroy(Order $order)
    {
        try {
            $order->orderItems()->delete();
            $order->delete();

            return response()->json(['message' => 'Data berhasil dihapus dari basis data.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Data gagal dihapus dari basis data.'], 500);
        }
    }

    /**
     * Mengambil data untuk datatable
     *
     * @return json
     */
    public function listOrder(Request $request)
    {
        $orders = Order::with('orderItems')->get();

        $totalData = $orders->count();

        $columns = [
            'id',
            'order_id',
            'created_at',
            'service',
            'therapist',
            'buyer_name',
            'referrer_name',
            'buyer_payment_method',
            'payment_status',
            'order_status'
        ];

        $totalFiltered = $totalData;
        $orderColumn = $request->input('order.0.column');

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$orderColumn];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value')) && !$request->has('date_start')) {
            $orders = $this->queryServerSider()
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->groupBy('orders.id')
                ->get();
        } else {
            $search = $request->input('search.value');

            $orders = $this->queryServerSider()
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->groupBy('orders.id')
                ->where(function ($query) use ($search) {
                    $this->searchQuery($query, $search);
                })
                ->where(function ($query) use ($request) {
                    $this->externalFilter($query, $request);
                })
                ->get();

            $allOrders = $this->queryServerSider()
                ->orderBy($order, $dir)
                ->groupBy('orders.id')
                ->where(function ($query) use ($search) {
                    $this->searchQuery($query, $search);
                })
                ->where(function ($query) use ($request) {
                    $this->externalFilter($query, $request);
                })
                ->get();

            $totalFiltered = $allOrders->count();
        }

        if (!empty($orders)) {
            $no = $start + 1;
            $data = array();
            foreach ($orders as $order) {
                $detailUrl = route('order.edit', $order->id);
                $deleteUrl = route('order.destroy', $order->id);

                $row = array();
                $row[]  = $no;
                $row[]  = $order->order_id;
                $row[]  = formatDate($order->created_at, 'd M Y');
                $row[]  = BaseService::tooltipText(Str::limit($order->service, 18), Str::limit($order->service, 500));
                $row[]  = OrderService::filterCoumnName($order->therapist);
                $row[]  = Str::words($order->buyer_name, 2, '');
                $row[]  = OrderService::filterCoumnName($order->referrer_name);
                $row[]  = $order->buyer_payment_method;
                $row[]  = OrderService::getPaymentStatus($order->payment_status);
                $row[]  = OrderService::getOrderStatus($order->order_status);
                $row[]  = BaseService::getActionButton($order->id, $detailUrl, $deleteUrl);
                $data[] = $row;

                $no++;
            }
        }

        return response()->json([
            "order"           => $start,
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data,
            "page"            => (intval($start) / 10),
        ]);
    }

    /**
     * Logic join table
     */
    protected function queryServerSider()
    {
        return Order::query()
            ->leftJoin('order_items', 'orders.id', 'order_items.order_id')
            ->leftJoin('therapists as therapists2', 'orders.therapist_id', 'therapists2.id')
            ->leftJoin('referrers', 'orders.referrer_id', 'referrers.id')
            ->leftJoin('patients', 'referrers.patient_id', 'patients.id')
            ->leftJoin('therapists', 'referrers.therapist_id', 'therapists.id')
            ->select([
                'orders.id',
                'orders.order_id',
                'orders.created_at',
                DB::raw(
                    'GROUP_CONCAT(tbr_order_items.service separator ", ") as service'
                ),
                'therapists2.name as therapist',
                'orders.buyer_name',
                DB::raw(
                    '(CASE WHEN tbr_referrers.patient_id IS NOT NULL THEN tbr_patients.name ELSE tbr_therapists.name END) as referrer_name'
                ),
                'orders.buyer_payment_method',
                'orders.payment_status',
                'orders.order_status',
            ]);
    }

    /**
     * Filter external datatable
     */
    protected function externalFilter($query, $request)
    {
        return
            $query->when($request->date_start, function ($query) use ($request) {
                $query->whereBetween('orders.created_at', [formatDate($request->date_start, 'Y-m-d 00:00:00'), formatDate($request->date_end, 'Y-m-d 23:59:59')]);
            })
            ->when($request->therapist, function ($query) use ($request) {
                $query->where('therapists2.name', $request->therapist);
            })
            ->when($request->referrer, function ($query) use ($request) {
                $query->whereRaw('CASE WHEN tbr_referrers.patient_id IS NOT NULL THEN tbr_patients.name ELSE tbr_therapists.name END = "' . $request->referrer . '"');
            });
    }

    /**
     * Logic pencarian
     */
    protected function searchQuery($query, $search)
    {
        return $query
            ->where('orders.order_id', 'LIKE', '%' . $search . '%')
            ->when(formatDateSearch($search, 'd M Y', 'Y-m-d'), function ($query) use ($search) {
                $query->orWhere('orders.created_at', 'LIKE', '%' . formatDateSearch($search, 'd M Y', 'Y-m-d') . '%');
            })
            ->orWhere('therapists2.name', 'LIKE', '%' . $search . '%')
            ->orWhere('buyer_name', 'LIKE', '%' . $search . '%')
            ->orWhereRaw(
                'CASE WHEN tbr_referrers.patient_id IS NOT NULL THEN tbr_patients.name ELSE tbr_therapists.name END LIKE "%' . $search . '%"'
            )
            ->orWhere('buyer_payment_method', 'LIKE', '%' . $search . '%')
            ->orWhere('payment_status', 'LIKE', '%' . $search . '%')
            ->orWhere('order_status', 'LIKE', '%' . $search . '%')
            ->orWhereHas('orderItems', function ($query) use ($search) {
                $query->where('service', 'LIKE', '%' . $search . '%');
            });
    }
}
