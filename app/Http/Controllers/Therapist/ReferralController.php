<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Therapist\ReferralRequest;
use App\Http\Requests\Therapist\Setting\AccountRequest;
use App\Http\Services\BaseService;
use App\Http\Services\FormWizardService;
use App\Http\Services\OrderService;
use App\Http\Services\ReferrerService;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Province;
use App\Models\Referrer;
use App\Models\Regency;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class ReferralController extends Controller
{
    /**
     * Menampilkan halaman konfirmasi referral
     *
     * @return view
     */
    public function confirmation()
    {
        return view('visitor.therapist.referral.confirmation');
    }

    /**
     * Menampilkan form aktivasi referral
     *
     * @return view
     */
    public function form()
    {
        $therapist = auth()->guard('therapist')->user();

        return view('visitor.therapist.referral.referral-form', [
            'therapist' => $therapist,
            'jobs' => FormWizardService::jobData(),
            'provinces' => Province::all(),
            'regencies' => Regency::where('province_id', $therapist->province_id)->get(),
            'districts' => District::where('regency_id', $therapist->regency_id)->get()
        ]);
    }

    /**
     * Aktivasi terapist referral
     *
     * @param  mixed $request
     * @return json
     */
    public function activate(ReferralRequest $request)
    {
        try {
            $therapist = auth()->guard('therapist')->user();
            $therapist->update($request->except([
                'business_community', 'business_name', 'business_address', 'bank_name', 'bank_account', 'account_number'
            ]));

            Referrer::create($request->only([
                'business_community', 'business_name', 'business_address', 'bank_name', 'bank_account', 'account_number'
            ]) + [
                'therapist_id' => $therapist->id,
                'unique_reff' => ReferrerService::generateUniqueReff()
            ]);

            session()->flash('register_status', 'success');

            return response()->json(['redirect' => route('therapist.referral.dashboard')], 200);
        } catch (\Throwable $th) {
            // return response()->json(['message' => $th->getMessage()], 500);
            return response()->json(['message' => Lang::get('general.error')], 500);
        }
    }

    /**
     * Update data rekening
     *
     * @param  mixed $request
     * @return json
     */
    public function updateAccount(AccountRequest $request)
    {
        try {
            $patient = auth()->guard('therapist')->user();
            $patient->referrer->update($request->validated());

            return response()->json(['message' => 'Anda telah berhasil melakukan update data.'], 200);
        } catch (\Throwable $th) {
            // return response()->json(['message' => $th->getMessage()], 500);
            return response()->json(['message' => 'Anda gagal dalam melakukan update data.'], 500);
        }
    }

    /**
     * Menampilkan halaman dashboard
     *
     * @return view
     */
    public function dashboard(Request $request)
    {
        $therapist = auth()->guard('therapist')->user();

        if (!$therapist->referrer()->exists()) {
            return redirect()->route('therapist.referral.confirmation');
        }

        return view('visitor.therapist.referral.dashboard', [
            'therapist' => $therapist,
            'setting' => Setting::first()
        ]);
    }

    /**
     * Mengambil data untuk datatable data transaksi
     *
     * @return json
     */
    public function list()
    {
        $therapist = auth()->guard('therapist')->user();
        $orders = Order::with('orderItems')->where('referrer_id', $therapist->referrer->id)->latest()->get();

        $no = 0;
        $data = array();
        foreach ($orders as $order) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = formatDate($order->created_at, 'd F Y');
            $row[] = BaseService::tooltipText(OrderService::getService($order->orderItems), OrderService::getService($order->orderItems, 500));
            $row[] = Str::words($order->buyer_name, 2, '');
            $row[] = Str::words($order->therapist->name, 2, '');
            $row[] = formatPrice($order->transaction_amount);
            $row[] = ReferrerService::getStatus($order->payment_status, $order->order_status);
            $row[] = formatPrice($order->orderItems->sum('referrer_fee'));
            $data[] = $row;
        }

        $output = array("data" => $data);

        return response()->json($output);
    }
}
