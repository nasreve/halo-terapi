<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use App\Http\Services\BaseService;
use App\Http\Services\OrderService;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan terapis
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $therapist = auth()->guard('therapist')->user();

        $orders = Order::where([
            'therapist_id' => $therapist->id,
            'order_status' => 'Selesai',
            'payment_status' => 'Sudah Dibayar'
        ])->with('orderItems')->get();

        return view('visitor.therapist.report.index', [
            'therapist' => $therapist,
            'orders' => $orders,
            'total_therapist_fee' => OrderService::getTotalTherapistFee($orders)
        ]);
    }

    /**
     * Mengambil data laporan pendapatan
     *
     * @return Illuminate\Http\Response
     */
    public function list()
    {
        $therapist = auth()->guard('therapist')->user();
        $orders = Order::where([
            'therapist_id' => $therapist->id,
            'order_status' => 'Selesai',
            'payment_status' => 'Sudah Dibayar'
        ])->with('orderItems')->get();

        $no = 0;
        $data = array();
        foreach ($orders as $order) {
            $order_link = route('therapist.order.detail', $order->id);

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = formatDate($order->created_at, 'd F Y');
            $row[] = OrderService::orderIdLink($order_link, $order->order_id);
            $row[] = Str::words($order->buyer_name, 2, '');
            $row[] = BaseService::tooltipText(OrderService::getService($order->orderItems, 10), OrderService::getService($order->orderItems, 500));
            $row[] = $order->buyer_payment_method;
            $row[] = formatPrice($order->orderItems->sum('rate'));
            $row[] = formatPrice($order->orderItems->sum('rate') - $order->orderItems->sum('therapist_fee'));
            $row[] = formatPrice($order->orderItems->sum('therapist_fee'));
            $data[] = $row;
        }

        $output = array("data" => $data);

        return response()->json($output);
    }
}
