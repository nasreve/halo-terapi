<?php

namespace App\Http\Controllers;

use App\Http\Services\BaseService;
use App\Http\Services\OrderService;
use App\Models\Order;
use App\Models\Referrer;
use App\Models\Therapist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan Admin
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('admin.report.index', [
            'therapists' => Therapist::get(),
            'referrers' => Referrer::get()
        ]);
    }

    /**
     * Mengambil data order yang sudah selesai untuk laporan
     *
     * @return Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $orders = Order::query()
            ->with('orderItems')
            ->where([
                'payment_status' => 'Sudah Dibayar',
                'order_status' => 'Selesai'
            ])
            ->get();

        $totalData = $orders->count();

        $totalCommission = OrderService::getTotalVendorFee($orders);

        $columns = [
            'id',
            'created_at',
            'order_id',
            'therapist',
            'service',
            'buyer_payment_method',
            'rate',
            'therapist_fee',
            'referrer_fee',
            'vendor_fee'
        ];

        $totalFiltered = $totalData;
        $orderColumn = $request->input('order.0.column');

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$orderColumn];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value')) && !$request->has('date_start')) {
            $orders = $this->queryServerSider()
                ->where([
                    'payment_status' => 'Sudah Dibayar',
                    'order_status' => 'Selesai'
                ])
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

            $totalCommission = OrderService::getTotalVendorFee($allOrders);
            $totalFiltered = $allOrders->count();
        }

        $no = $start + 1;
        $data = array();
        foreach ($orders as $order) {
            $order_link = route('order.edit', $order->id);

            $row = array();
            $row[]  = $no;
            $row[]  = formatDate($order->created_at, 'd M Y');
            $row[]  = OrderService::orderIdLink($order_link, $order->order_id);
            $row[]  = OrderService::filterCoumnName($order->therapist);
            $row[]  = BaseService::tooltipText(Str::limit($order->service, 18), Str::limit($order->service, 500));
            $row[]  = $order->buyer_payment_method;
            $row[]  = formatPrice($order->rate);
            $row[]  = formatPrice($order->therapist_fee);
            $row[]  = OrderService::getReportReferralFee($order->referrer_fee, $order->referrer_name);
            $row[]  = formatPrice($order->vendor_fee);
            $data[] = $row;

            $no++;
        }

        return response()->json([
            "order"           => $start,
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data,
            "page"            => (intval($start) / 10),
            "totalCommission" => formatNumberTwoComas($totalCommission)
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
                'orders.created_at',
                'orders.order_id',
                'therapists2.name as therapist',
                DB::raw(
                    'GROUP_CONCAT(tbr_order_items.service separator ", ") as service'
                ),
                'orders.buyer_payment_method',
                DB::raw(
                    'SUM(tbr_order_items.rate) as rate'
                ),
                DB::raw(
                    'SUM(tbr_order_items.therapist_fee) as therapist_fee'
                ),
                DB::raw(
                    '(CASE WHEN tbr_referrers.patient_id IS NOT NULL THEN tbr_patients.name ELSE tbr_therapists.name END) as referrer_name'
                ),
                DB::raw(
                    'SUM(tbr_order_items.referrer_fee) as referrer_fee'
                ),
                DB::raw(
                    'SUM(tbr_order_items.vendor_fee) as vendor_fee'
                ),
            ])
            ->where([
                'payment_status' => 'Sudah Dibayar',
                'order_status' => 'Selesai'
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
            ->when($request->all_payment, function ($query) use ($request) {
                $query->where('orders.buyer_payment_method', $request->all_payment);
            })
            ->when($request->all_therapist, function ($query) use ($request) {
                $query->where('therapists2.name', $request->all_therapist);
            })
            ->when($request->all_referrer, function ($query) use ($request) {
                $query->whereRaw('CASE WHEN tbr_referrers.patient_id IS NOT NULL THEN tbr_patients.name ELSE tbr_therapists.name END = "' . $request->all_referrer . '"');
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
            ->orWhere('buyer_payment_method', 'LIKE', '%' . $search . '%')
            ->orWhere('rate', 'LIKE', '%' . $search . '%')
            ->orWhere('therapist_fee', 'LIKE', '%' . $search . '%')
            ->orWhere('referrer_fee', 'LIKE', '%' . $search . '%')
            ->orWhereRaw(
                'CASE WHEN tbr_referrers.patient_id IS NOT NULL THEN tbr_patients.name ELSE tbr_therapists.name END LIKE "%' . $search . '%"'
            )
            ->orWhere('vendor_fee', 'LIKE', '%' . $search . '%')
            ->orWhereHas('orderItems', function ($query) use ($search) {
                $query->where('service', 'LIKE', '%' . $search . '%');
            });
    }
}
