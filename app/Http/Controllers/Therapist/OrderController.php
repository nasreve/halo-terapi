<?php

namespace App\Http\Controllers\Therapist;

use PDF;
use App\Http\Controllers\Controller;
use App\Http\Services\BaseService;
use App\Http\Services\FormWizardService;
use App\Http\Services\OrderService;
use App\Http\Services\ReferrerService;
use App\Models\Order;
use App\Models\Setting;
use App\Rules\PaymentRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Menampilkan halaman order history terapis
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $therapist = auth()->guard('therapist')->user();

        return view('visitor.therapist.order-history.index', [
            'therapist' => $therapist
        ]);
    }

    /**
     * Menampilkan halaman repeat order
     *
     * @param  App\Model\Order $order
     * @return Illuminate\View\View
     */
    public function repeat(Order $order)
    {
        return view('visitor.therapist.order.repeat.index', compact('order') + [
            'setting' => Setting::first(),
            'rates' => OrderService::getServiceRealPrice($order),
            'transaction_amount' => OrderService::getTransactionAmountReal($order)
        ]);
    }

    /**
     * Menduplikat data order
     *
     * @param  App\Model\Order $order
     * @return Illuminate\Http\Response
     */
    public function replicate(Order $order)
    {
        $therapist = auth()->guard('therapist')->user();

        try {
            foreach ($order->orderItems as $orderItem) {
                if (OrderService::checkServiceApproved($therapist, $orderItem->service) === false) {
                    return response()->json(['status' => 'failed', 'message' => Lang::get('general.service.not-approved')], 500);
                };
            }

            $newOrder = $order->replicate([
                'referrer_id', 'payment_status', 'payment_date', 'order_status', 'paid_amount', 'cashback_amount', 'transaction_amount'
            ]);

            $newOrder->push();

            foreach ($order->orderItems as $orderItem) {
                $rate = OrderService::getActualPrice($therapist, $orderItem->service);

                $newOrderItem = $orderItem->replicate([
                    'rate', 'referrer_fee', 'therapist_fee', 'vendor_fee'
                ]);

                $newOrderItem->order_id = $newOrder->id;
                $newOrderItem->rate = $rate;
                $newOrderItem->therapist_fee = FormWizardService::getTherapistFee($rate);
                $newOrderItem->vendor_fee = FormWizardService::getVendorFee($rate, ReferrerService::checkReferrerStatus($order->referrer_id));
                $newOrderItem->save();

                $newOrder->transaction_amount = $newOrder->transaction_amount + $newOrderItem->rate;
            }

            $newOrder->order_id = OrderService::generateOrderId();
            $newOrder->referrer_id = ReferrerService::checkReferrerStatus($order->referrer_id);
            $newOrder->save();

            FormWizardService::sendEmail($newOrder);

            session()->flash('repeat_order_status', 'success');

            return response()->json(['status' => 'success', 'redirect' => route('therapist.order.detail', $newOrder->id)], 200);
        } catch (\Throwable $th) {
            // return response()->json(['status' => 'failed', 'message' => $th->getMessage()], 500);
            return response()->json(['status' => 'failed', 'message' => Lang::get('general.error')], 500);
        }
    }

    /**
     * Menampilkan detail order
     *
     * @return Illuminate\View\View
     */
    public function view(Order $order)
    {
        $this->checkOrder($order);

        return view('visitor.therapist.order-history.detail', compact('order'));
    }

    /**
     * update data order
     *
     * @param  Illuminate\Http\Request $request
     * @param  App\Model\Order $order
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'sometimes|required',
            'payment_status' => 'sometimes|required',
            'paid_amount' => new PaymentRule($order->transaction_amount)
        ], [], [
            'order_status' => 'status pemesanan',
            'payment_status' => 'status pembayaran',
        ]);

        try {
            if ($request->paid_amount) {
                $order->update([
                    'paid_amount' => intval(str_replace(".", "", $request->paid_amount)),
                    'cashback_amount' => intval(str_replace(".", "", $request->paid_amount)) - $order->transaction_amount
                ]);
            } elseif ($order->buyer_payment_method === "Transfer") {
                $order->update([
                    'order_status' => $request->order_status
                ]);
            } elseif ($order->buyer_payment_method === "Cash") {
                $order->update([
                    'payment_status' => $request->payment_status,
                    'order_status' => $request->order_status
                ]);

                if ($request->payment_status === "Sudah Dibayar") {
                    $order->update([
                        'payment_date' => now(),
                    ]);
                } elseif ($request->payment_status === "Belum Dibayar") {
                    $order->update([
                        'payment_date' => null,
                        'paid_amount' => null,
                        'cashback_amount' => null
                    ]);
                }
            }

            $this->setReferrerFee($order);

            return response()->json(['message' => 'Anda telah berhasil melakukan update data.'], 200);
        } catch (\Throwable $th) {
            // return response()->json(['message' => $th->getMessage()], 500);
            return response()->json(['message' => 'Anda gagal dalam melakukan update data.'], 500);
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
     * Mengambil data order untuk datatable
     *
     * @return Illuminate\Http\Response
     */
    public function list()
    {
        $therapist = auth()->guard('therapist')->user();
        $orders = Order::where(function ($query) use ($therapist) {
            $query->where('therapist_id', $therapist->id)
                ->where('payment_status', 'Sudah Dibayar')
                ->where('buyer_payment_method', 'Transfer');
        })->orWhere(function ($query) use ($therapist) {
            $query->where('therapist_id', $therapist->id)
                ->where('buyer_payment_method', 'Cash');
        })->with('orderItems')->latest()->get();

        $no = 0;
        $data = array();
        foreach ($orders as $order) {
            $detailUrl = route('therapist.order.detail', $order->id);
            $repeatOrderUrl = route('therapist.order.repeat', $order->id);

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $order->order_id;
            $row[] = BaseService::tooltipText(OrderService::getService($order->orderItems, 10), OrderService::getService($order->orderItems, 500));
            $row[] = Str::words($order->buyer_name, 2, '');
            $row[] = OrderService::getPaymentStatusOrderHistory($order);
            $row[] = OrderService::getOrderStatus($order->order_status);
            $row[] = OrderService::getContactButton($order);
            $row[] = OrderService::orderHistoryAction($detailUrl, $repeatOrderUrl);
            $data[] = $row;
        }

        $output = array("data" => $data);

        return response()->json($output);
    }

    /**
     * Mencetak invoice pesanan
     *
     * @param  App\Model\Order $order
     * @return void
     */
    public function invoicePrint(Order $order)
    {
        $this->checkOrder($order);

        return view('visitor.patient.order-history.invoice-print', compact('order') + [
            'setting' => Setting::first()
        ]);
    }

    /**
     * Mendownload invoice pesanan
     *
     * @param  App\Model\Order $order
     * @return void
     */
    public function invoiceDownload(Order $order)
    {
        $this->checkOrder($order);

        $pdf = PDF::loadView('visitor.patient.order-history.invoice-download', compact('order') + [
            'setting' => Setting::first()
        ]);
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed' => TRUE,
                    'verify_peer'       => FALSE,
                    'verify_peer_name'  => FALSE,
                ]
            ])
        );

        return $pdf->download("INVOICE - {$order->order_id}.pdf");
    }

    /**
     * Middleware
     *
     * @param  App\Model\Order $order
     * @return void
     */
    protected function checkOrder($order)
    {
        $therapist = auth()->guard('therapist')->user();
        if ($order->therapist_id != $therapist->id) {
            abort(404);
        }
    }
}
