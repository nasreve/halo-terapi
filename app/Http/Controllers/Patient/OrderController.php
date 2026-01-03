<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Services\BaseService;
use App\Http\Services\FormWizardService;
use App\Http\Services\OrderService;
use App\Http\Services\ReferrerService;
use App\Models\Setting;
use App\Models\Order;
use App\Models\Patient;
use App\Models\Therapist;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PDF;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Menmampilkan halaman history order
     *
     * @return view
     */
    public function index()
    {
        return view('visitor.patient.order-history.index');
    }

    /**
     * Data history order
     *
     * @return json
     */
    public function list()
    {
        $patient = auth()->guard('patient')->user();
        $orders = Order::where('patient_id', $patient->id)->with('orderItems')->latest()->get();

        $no = 0;
        $data = array();
        foreach ($orders as $order) {
            $detailUrl = route('patient.order.detail', $order->id);
            $repeatOrderUrl = route('order.repeat', $order->id);

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $order->order_id;
            $row[] = BaseService::tooltipText(OrderService::getService($order->orderItems, 10), OrderService::getService($order->orderItems, 500));
            $row[] = Str::words($order->therapist->name, 2, '');
            $row[] = formatPrice($order->transaction_amount);
            $row[] = $order->buyer_payment_method;
            $row[] = OrderService::getPaymentStatusOrderHistory($order);
            $row[] = OrderService::orderHistoryAction($detailUrl, $repeatOrderUrl);
            $data[] = $row;
        }
        $output = array("data" => $data);

        return response()->json($output);
    }

    /**
     * Menampilkan detail order
     *
     * @return view
     */
    public function view(Order $order)
    {
        $this->checkOrder($order);

        return view('visitor.patient.order-history.detail', compact('order') + [
            'setting' => Setting::first()
        ]);
    }

    /**
     * Menampilkan halaman repeat order
     *
     * @param  mixed $order
     * @return view
     */
    public function repeat(Order $order)
    {
        $this->checkOrder($order);

        return view('visitor.patient.order.repeat.index', compact('order') + [
            'setting' => Setting::first(),
            'rates' => OrderService::getServiceRealPrice($order),
            'transaction_amount' => OrderService::getTransactionAmountReal($order)
        ]);
    }

    /**
     * Menduplikat data order
     *
     * @param  App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function replicate(Order $order)
    {
        try {
            $therapist = Therapist::where([
                'id' => $order->therapist_id,
                'status' => 'Disetujui',
                'blocked' => 0
            ])->firstOrFail();

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

            session()->flash('success', 'true');

            return response()->json(['status' => 'success', 'redirect' => route('patient.order.detail', $newOrder->id)], 200);
        } catch (ModelNotFoundException $th) {
            return response()->json(['status' => 'failed', 'message' => Lang::get('general.notavailable')], 500);
        } catch (\Throwable $th) {
            // return response()->json(['status' => 'failed', 'message' => $th->getMessage()], 500);
            return response()->json(['status' => 'failed', 'message' => Lang::get('general.error')], 500);
        }
    }

    /**
     * Mencetak invoice pesanan
     *
     * @param  mixed $order
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
     * @param  mixed $order
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
     * @param  mixed $order
     * @return void
     */
    protected function checkOrder($order)
    {
        $patient = auth()->guard('patient')->user();
        if ($order->patient_id != $patient->id) {
            abort(404);
        }
    }
}
