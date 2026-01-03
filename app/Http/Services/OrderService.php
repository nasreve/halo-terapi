<?php

namespace App\Http\Services;

use App\Models\Order;
use App\Models\Patient;
use App\Models\Referrer;
use App\Models\Therapist;
use App\Models\TherapistService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class OrderService
{
    /**
     * Menggenerate order id
     *
     * @return string
     */
    public static function generateOrderId(): string
    {
        $increment = 0;
        $order_id = "HT" . now()->format('y') . now()->format('m') . now()->format('d') . '001';
        $order = Order::where('order_id', $order_id)->first();

        while ($order) {
            $increment += 1;
            $order_id = "HT" . now()->format('y') . now()->format('m') . now()->format('d') . str_pad($increment, 3, "0", STR_PAD_LEFT);
            $order = Order::where('order_id', $order_id)->first();
        }

        return $order_id;
    }

    /**
     * Membuat order id warna hijau dan clickable
     *
     * @param  mixed $url
     * @param  mixed $order_id
     * @return string
     */
    public static function orderIdLink($url, $order_id)
    {
        return "<a href='{$url}' class='tbr_text-primary'>{$order_id}</div>";
    }

    /**
     * Mengambil semua service
     *
     * @param  mixed $orderItems
     * @param  integer $length
     * @return string
     */
    public static function getService($orderItems, int $length = 18)
    {
        $array = $orderItems->pluck('service')->toArray();
        return Str::limit(implode(", ", $array), $length, ' ...');
    }

    /**
     * Mengambil semua data referrer
     *
     * @return array
     */
    public static function getAllReferrer(): array
    {
        $referrers = Referrer::all();
        $listReferrer = [];
        foreach ($referrers as $referrer) {
            $listReferrer[] = $referrer->getReferrerName();
        }

        return $listReferrer;
    }

    /**
     * Mengambil status pembayaran
     *
     * @param  string $status
     * @return string
     */
    public static function getPaymentStatus($status): string
    {
        if ($status === "Sudah Dibayar") {
            return "<span class='tbr_label tbr_label-light-primary tbr_label_order'>Sudah Dibayar</span>";
        }

        if ($status === "Belum Dibayar") {
            return "<span class='tbr_label tbr_label-light-danger tbr_label_order'>Belum Dibayar</span>";
        }

        return "";
    }

    /**
     * Mengambil status pembayaran
     *
     * @param  mixed $order
     * @return string
     */
    public static function getPaymentStatusOrderHistory($order): string
    {
        if ($order->payment_status === "Sudah Dibayar") {
            return "<span class='tbr_label tbr_label-light-primary'>Sudah Dibayar</span>";
        }

        if ($order->payment_status === "Belum Dibayar") {
            return "<span class='tbr_label tbr_label-light-danger'>Belum Dibayar</span>";
        }

        return "";
    }

    /**
     * Mengambil status pembelian
     *
     * @param  string $status
     * @return string
     */
    public static function getOrderStatus($status): string
    {
        if ($status === "Selesai") {
            return "<span class='tbr_label tbr_label-light-primary'>Selesai</span>";
        }

        if ($status === "Terjadwal") {
            return "<span class='tbr_label tbr_label-light-warning'>Terjadwal</span>";
        }

        if ($status === "Menunggu") {
            return "<span class='tbr_label tbr_label-light-light tbr_label_grey'>Menunggu</span>";
        }

        return "";
    }

    /**
     * Menjumlahkan total harga order dari profile terapis
     *
     * @return int
     */
    public static function totalPriceProfileOrder($username): int
    {
        $amount = 0;

        $therapist = Therapist::where('username', $username)->first();

        if ($therapist)
            foreach (session('therapistOrder') as $order) {
                $amount += optional(TherapistService::where('therapist_id', $therapist->id)->where('service_id', $order['service_id'])->first())->rate;
            }

        return $amount;
    }

    /**
     * Membuat tombol aksi untuk order history
     *
     * @return string
     */
    public static function orderHistoryAction($detailUrl, $repeatOrderUrl)
    {
        return "
            <a href='{$repeatOrderUrl}' class='tbr_text-warning tbr_weight-semi-bold mr-3'>Repeat Order</a>
            <a href='{$detailUrl}' class='tbr_text-success tbr_weight-semi-bold mr-0'>Detail</a>
        ";
    }

    /**
     * Membuat tombol kontak
     *
     * @param  \App\Models\Order $order
     * @return string
     */
    public static function getContactButton(Order $order)
    {
        return '
        <a  href="https://api.whatsapp.com/send/?phone=62' . $order->buyer_whatsapp . '"
            class="mr-2"
            data-toggle="tooltip"
            data-placement="left"
            title="Hubungi ' . $order->buyer_name . ' melalui chatting WhatsApp"
            target="_blank">
            <img src="' . asset('/assets/svg/icons/icon_v_whatsapp.svg') . '" alt="WhatsApp">
        </a>
        <a  href="tel:+62' . $order->buyer_phone . '"
            class="mr-0"
            data-toggle="tooltip"
            data-placement="left"
            title="Hubungi ' . $order->buyer_name . ' melalui telepon"
            target="_blank">
            <img src="' . asset('/assets/svg/icons/icon_v_phone.svg') . '" alt="Phone">
        </a>';
    }

    /**
     * Menjumlahkan bayaran dan mengambil nama referrer
     *
     * @return string
     */
    public static function getReportReferralFee($price, $referrer)
    {
        $formatted_price = formatPrice($price);
        $long_referrer_name = $referrer;
        $sort_referrer_name = Str::words($referrer, 2, '');

        return "
            <span>{$formatted_price}</span>
            <br/>
            <i class='tbr_text-light-2'>{$sort_referrer_name}</i>
            <span class='d-none'>{$long_referrer_name}</div>
        ";
    }

    /**
     * Menjumlahkan total pendapatan vendor / admin
     *
     * @param  Illuminate\Database\Eloquent\Collection $orders
     * @return string
     */
    public static function getTotalVendorFee(Collection $orders)
    {
        $total_fee = 0;

        foreach ($orders as $order) {
            $total_fee += $order->orderItems->sum('vendor_fee');
        }

        return $total_fee;
    }

    /**
     * Menjumlahkan total pendapatan terapis
     *
     * @param  Illuminate\Database\Eloquent\Collection $orders
     * @return string
     */
    public static function getTotalTherapistFee(Collection $orders)
    {
        $total_fee = 0;

        foreach ($orders as $order) {
            $total_fee += $order->orderItems->sum('therapist_fee');
        }

        return $total_fee;
    }

    /**
     * Mengambil referrer id dari session (jika ada)
     */
    public static function getReferrerId()
    {
        $patient = auth()->guard('patient')->user();

        if (session()->has('referral_code')) {
            if (!$patient->referrer()->exists()) {
                return Referrer::where('unique_reff', session('referral_code'))->first()->id;
            }

            if ($patient->referrer->unique_reff != session('referral_code')) {
                return Referrer::where('unique_reff', session('referral_code'))->first()->id;
            }

            return null;
        }

        return null;
    }

    /**
     * Mengecek kode referrer
     *
     * @param  mixed $code
     * @param  App\Models\Patient $patient
     * @return string
     */
    public static function checkReferrerId($code, Patient $patient)
    {
        if (!$code) {
            return null;
        }

        $referrer = Referrer::where([
            'unique_reff' => $code,
            'blocked' => 0
        ])->with([
            'therapist',
            'patient'
        ])->first();

        if (!$referrer) {
            return null;
        }

        if ($referrer->patient()->exists() && $referrer->patient->blocked) {
            return null;
        }

        if ($referrer->therapist()->exists() && $referrer->therapist->blocked) {
            return null;
        }

        if (!$patient->referrer()->exists()) {
            return optional($referrer)->id;
        }

        if ($patient->referrer->unique_reff != $code) {
            return optional($referrer)->id;
        }

        return null;
    }

    /**
     * Memperpendek data dan menambahkan data asli yang
     * di hidden untuk membantu dalam filter datatable
     *
     * @param  string $long_data
     * @return string
     */
    public static function filterCoumnName($long_data)
    {
        if ($long_data === null) {
            return "No Data";
        }

        $sort_data = Str::words($long_data, 2, '');

        return "
            <span>{$sort_data}</span>
            <span class='d-none' />
                {$long_data}
            </div>
        ";
    }

    /**
     * Mengambil harga layanan asli
     *
     * @param  mixed $order
     * @return array
     */
    public static function getServiceRealPrice(Order $order)
    {
        $therapist = $order->therapist;
        $rates = [];

        foreach ($order->orderItems as $index => $orderItem) {
            $rates[] = optional(optional($therapist->services->where('title', $orderItem->service)->first())->pivot)->rate;
        }

        return $rates;
    }

    /**
     * Mengambil total harga layanan asli
     *
     * @param  mixed $order
     * @return integer
     */
    public static function getTransactionAmountReal(Order $order)
    {
        $therapist = $order->therapist;
        $total = 0;

        foreach ($order->orderItems as $index => $orderItem) {
            $total += optional(optional($therapist->services->where('title', $orderItem->service)->first())->pivot)->rate;
        }

        return $total;
    }

    /**
     * Cek apakah terapis masih melayani wilayah order
     *
     * @param  mixed $therapist
     * @param  mixed $order
     * @return boolean
     */
    public static function checkTherapistArea(Therapist $therapist, Order $order)
    {
        $province_id = getProvinceIdByName($order->buyer_province);
        $regency_ids = $therapist->therapistAreas->pluck('regency_id')->toArray();
        $regency_id = getRegencyIdByName($province_id, $order->buyer_regency);
        $district_ids = $therapist->therapistAreas->pluck('district_id')->toArray();
        $district_id = getDistrictIdByName($regency_id, $order->buyer_district);

        if (!in_array($regency_id, $regency_ids) || !in_array($district_id, $district_ids)) {
            return false;
        }

        return true;
    }

    /**
     * Cek layanan disetujui atau tidak.
     *
     * @param  mixed $therapist
     * @param  mixed $service_name
     * @return boolean
     */
    public static function checkServiceApproved(Therapist $therapist, $service_name)
    {
        $therapistServices = $therapist->services->where('title', $service_name)->first();
        if ($therapistServices) {
            if (optional(optional($therapistServices)->pivot)->status !== "Diterima") {
                return false;
            }

            return true;
        }
    }

    /**
     * Cek layanan disetujui atau tidak untuk form wizard.
     *
     * @param  mixed $therapist
     * @param  mixed $service_id
     * @return boolean
     */
    public static function checkServiceApprovedFZ(Therapist $therapist, $service_id)
    {
        $therapistServices = $therapist->services->where('id', $service_id)->first();
        if ($therapistServices) {
            if (optional(optional($therapistServices)->pivot)->status !== "Diterima") {
                return false;
            }

            return true;
        }
    }

    /**
     * Mengambil harga sesungguhnya
     *
     * @param  mixed $therapist
     * @param  mixed $service_name
     * @return integer
     */
    public static function getActualPrice(Therapist $therapist, $service_name)
    {
        $therapistServices = $therapist->services->where('title', $service_name)->first();
        if ($therapistServices) {
            return optional(optional($therapistServices)->pivot)->rate;
        }
    }
}
