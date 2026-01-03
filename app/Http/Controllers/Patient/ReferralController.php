<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Therapist\Setting\AccountRequest;
use App\Http\Requests\Patient\ReferralRequest;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class ReferralController extends Controller
{
    /**
     * Menyimpan code referral ke session yang
     * nanti nya akan di gunakan dalam order
     *
     * @param  mixed $code
     * @return void
     */
    public function code($code)
    {
        $referrer = Referrer::where([
            'unique_reff' => $code,
            'blocked' => 0
        ])->with('patient', 'therapist')->first();

        if (!$referrer) {
            return redirect()->route('home');
        }

        if ($referrer->patient->blocked === 0) {
            session(['referral_code' => $code]);
            return redirect()->route('home');
        }

        if ($referrer->therapist->blocked === 0 && $referrer->therapist->status === "Disetujui") {
            session(['referral_code' => $code]);
            return redirect()->route('home');
        }

        return redirect()->route('home');
    }

    /**
     * Menampilkan halaman konfirmasi referral
     *
     * @return view
     */
    public function confirmation()
    {
        return view('visitor.patient.referral.confirmation');
    }

    /**
     * Menampilkan form aktivasi referral
     *
     * @return view
     */
    public function form()
    {
        $patient = auth()->guard('patient')->user();

        return view('visitor.patient.referral.referral-form', [
            'patient' => $patient,
            'jobs' => FormWizardService::jobData(),
            'provinces' => Province::all(),
            'regencies' => Regency::where('province_id', $patient->province_id)->get(),
            'districts' => District::where('regency_id', $patient->regency_id)->get()
        ]);
    }

    /**
     * Aktivasi pasien sebagai referral
     *
     * @param  mixed $request
     * @return json
     */
    public function activate(ReferralRequest $request)
    {
        try {
            $patient = auth()->guard('patient')->user();
            $patient->update($request->except([
                'business_community', 'business_name', 'business_address', 'bank_name', 'bank_account', 'account_number'
            ]));

            Referrer::create($request->only([
                'business_community', 'business_name', 'business_address', 'bank_name', 'bank_account', 'account_number'
            ]) + [
                'patient_id' => $patient->id,
                'unique_reff' => ReferrerService::generateUniqueReff()
            ]);

            session()->flash('register_status', 'success');

            return response()->json(['redirect' => route('patient.referral.dashboard')], 200);
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
            $patient = auth()->guard('patient')->user();
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
        $patient = auth()->guard('patient')->user();

        if (!$patient->referrer()->exists()) {
            return redirect()->route('patient.referral.confirmation');
        }

        return view('visitor.patient.referral.dashboard', [
            'patient' => $patient
        ]);
    }

    /**
     * Mengambil data untuk datatable data transaksi
     *
     * @return json
     */
    public function list()
    {
        $patient = auth()->guard('patient')->user();
        $orders = Order::with('orderItems')->where('referrer_id', $patient->referrer->id)->latest()->get();

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
