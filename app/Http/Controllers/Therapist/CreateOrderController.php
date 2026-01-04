<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Requests\Therapist\Order\PatientDataRequest;
use App\Http\Services\FormWizardService;
use App\Http\Services\OrderService;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Patient;
use App\Models\Province;
use App\Models\Referrer;
use App\Models\Regency;
use App\Models\Service;
use App\Models\Setting;
use App\Notifications\EmailVerifyPasswordReset;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateOrderController extends Controller
{
    /**
     * Menampilkan halaman step 1 order
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\View\View;
     */
    public function step1(Request $request)
    {
        if (!session()->has('therapistSelfOrder')) {
            session(['therapistSelfOrder' => collect()]);
        }

        $this->saveServicePageToSession($request);

        $therapist = auth()->guard('therapist')->user();

        return view('visitor.therapist.order.step-1', [
            'therapist' => $therapist,
            'selectedService' => $therapist->services->whereIn('id', session('therapistSelfOrder')->pluck('service_id')),
            'page' => session('selfPage')
        ]);
    }

    /**
     * Menyimpan layanan yang di pilih ke session
     *
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    public function selectService(Request $request)
    {
        $collection = session('therapistSelfOrder');

        if ($collection->where('service_id', $request->service_id)->count() === 0) {
            $collection->push([
                'service_id' => $request->service_id,
            ]);

            session(['therapistSelfOrder' => $collection]);
        } else {
            $filtered = $collection->filter(function ($value, $key) use ($request) {
                return $value['service_id'] != $request->service_id;
            });

            session(['therapistSelfOrder' => $filtered]);
        }
    }

    /**
     * Menyimpan data halaman pagination
     * ke session
     *
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    protected function saveServicePageToSession(Request $request)
    {
        if (!$request->has('page')) {
            return false;
        }

        return session(['selfPage' => $request->page]);
    }

    /**
     * Menampilkan halaman step 2
     *
     * @return Illuminate\View\View
     */
    public function step2()
    {
        if (!session()->has('step2dataSelf')) {
            session(['step2dataSelf' => new Order()]);
        }

        if (!session()->has('therapistSelfOrder') || session('therapistSelfOrder')->isEmpty()) {
            return redirect()->route('therapist.order.step-1');
        }

        $regencies = Regency::where('province_id', session('step2dataSelf')->province_id)->get();
        $districts = District::where('regency_id', session('step2dataSelf')->regency_id)->get();

        return view('visitor.therapist.order.step-2', compact('regencies', 'districts') + [
            'jobs' => FormWizardService::jobData(),
            'provinces' => Province::all()
        ]);
    }

    /**
     * Menyimpan data step ke 2 ke session
     *
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    public function step2Data(Request $request)
    {
        try {
            $patient = Patient::where('email', $request->email)->first();
            if (!$patient) {
                session()->forget('no_create_user');
            }

            $step2data = new Patient($request->all());

            if ($request->has('symptoms')) {
                $step2data->symptoms = $request->symptoms;
            }

            if ($request->has('unique_reff')) {
                $step2data->unique_reff = $request->unique_reff;
            }

            $step2data->payment_method = $request->payment_method;

            session(['step2dataSelf' => $step2data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => Lang::get('general.error')], 500);
        }
    }

    /**
     * Cek email apakah sudah ada di database.
     *
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    public function step2email(Request $request)
    {
        try {
            $patient = Patient::where('email', $request->email)->first();
            if ($patient) {
                return response()->json(['status' => 'Found'], 200);
            }

            return response()->json(['status' => 'Not found']);
        } catch (\Throwable $th) {
            return response()->json(['message' => Lang::get('general.error')], 500);
        }
    }

    /**
     * Menerapkan data user yang sudah ada.
     */
    public function step2emailApply(Request $request)
    {
        $patient = Patient::where('email', $request->email)->first();

        if ($request->has('apply')) {
            $step2data = new Patient($patient->toArray());

            if ($request->has('symptoms')) {
                $step2data->symptoms = $request->symptoms;
            }

            if ($request->has('unique_reff')) {
                $step2data->unique_reff = $request->unique_reff;
            }

            if ($request->has('payment_method')) {
                $step2data->buyer_payment_method = $request->payment_method;
            }

            session(['no_create_user' => true]);

            return session([
                'step2dataSelf' => $step2data
            ]);
        }

        return session()->forget('no_create_user');
    }

    /**
     * Validasi step ke 2
     *
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    public function step2submit(PatientDataRequest $request)
    {
        return response()->json(['redirect' => route('therapist.order.step-3'), 200]);
    }

    /**
     * Menampilkan halaman step ke 3 order
     *
     * @param  App\Http\Requests\Therapist\Order\PatientDataRequest $request
     * @return Illuminate\View\View
     */
    public function step3()
    {
        if ($this->step3Validation()->fails()) {
            return redirect()->route('therapist.order.step-2');
        }

        $therapist = auth()->guard('therapist')->user();
        $services = $therapist->services->whereIn('id', session('therapistSelfOrder')->pluck('service_id'));

        return view('visitor.therapist.order.step-3', [
            'services' => $services,
            'therapist' => $therapist,
            'setting' => Setting::first()
        ]);
    }

    /**
     * Validasi step 3
     *
     * @return Illuminate\Support\Facades\Validator
     */
    protected function step3Validation()
    {
        $request = new PatientDataRequest();
        return Validator::make(session('step2dataSelf')->toArray(), $request->rules(), $request->messages(), $request->attributes());
    }

    /**
     * Menghapus layanan yang telah dipilih
     *
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    public function step3delete(Request $request)
    {
        try {
            $data = session('therapistSelfOrder');

            $filteredData = $data->filter(function ($value, $key) use ($request) {
                return $value['service_id'] != $request->service_id;
            });

            session(['therapistSelfOrder' => $filteredData]);
        } catch (\Throwable $th) {
            return response()->json(['message' => Lang::get('general.error')], 500);
        }
    }

    /**
     * Membuat pasien dan order baru.
     *
     * @return Illuminate\Http\Response
     */
    public function step3submit()
    {
        try {
            if (session()->has('no_create_user')) {
                $patient = Patient::where('email', session('step2dataSelf')->email)->first();
            } else {
                $patient = Patient::create(session('step2dataSelf')->toArray() + [
                    'email_verified_at' => now()
                ]);
            }

            $therapist = auth()->guard('therapist')->user();

            $order = Order::create([
                'order_id' => OrderService::generateOrderId(),
                'patient_id' => $patient->id,
                'therapist_id' => $therapist->id,
                'referrer_id' => OrderService::checkReferrerId(session('step2dataSelf')->unique_reff, $patient),
                'buyer_name' => $patient->name,
                'buyer_age' => ageFormat($patient->date_of_birth),
                'buyer_gender' => $patient->gender,
                'buyer_job' => $patient->job,
                'buyer_phone' => $patient->phone_number,
                'buyer_whatsapp' => $patient->whatsapp_number,
                'buyer_email' => $patient->email,
                'buyer_province' => getProvinceName($patient->province_id),
                'buyer_regency' => getRegencyName($patient->regency_id),
                'buyer_district' => getDistrictName($patient->district_id),
                'buyer_sub_district' => $patient->village,
                'buyer_address' => $patient->address,
                'buyer_payment_method' => session('step2dataSelf')->payment_method,
                'buyer_symptoms' => session('step2dataSelf')->symptoms,
                'buyer_bank_name' => Setting::first()->bank_name,
                'buyer_account' => Setting::first()->bank_account,
                'buyer_account_number' => Setting::first()->account_number,
                'payment_status' => 'Belum Dibayar',
            ]);

            foreach (session('therapistSelfOrder') as $service) {
                $rate = FormWizardService::getTherapistRate($order->therapist_id, $service['service_id']);
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'service' => Service::find($service['service_id'])->title,
                    'rate' => $rate,
                    'therapist_fee' => FormWizardService::getTherapistFee($rate, $service['service_id']),
                    'vendor_fee' => FormWizardService::getVendorFee($rate, $order->referrer_id, $service['service_id']),
                    'referrer_fee' => null
                ]);

                $order->update([
                    'transaction_amount' => $order->transaction_amount + $orderItem->rate
                ]);
            }

            if (!session()->has('no_create_user')) {
                $credentials = [
                    'email' => $patient->email
                ];

                Password::broker('patients')->sendResetLink($credentials, function ($user, $token) use ($patient) {
                    Notification::send($user, new EmailVerifyPasswordReset($patient, $token));
                });
            }

            FormWizardService::sendEmail($order);

            $this->resetAllSession();

            session()->flash('new_order_status', 'success');

            return response()->json(['redirect' => route('therapist.order.detail', $order->id)]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
            return response()->json(['message' => Lang::get('general.error')], 500);
        }
    }

    /**
     * Mereset semua session
     *
     * @return void
     */
    public function resetAllSession()
    {
        if (session()->has('therapistSelfOrder')) {
            session(['therapistSelfOrder' => collect()]);
        }

        if (session()->has('step2dataSelf')) {
            session(['step2dataSelf' => new Order()]);
        }

        if (session()->has('selfPage')) {
            session()->forget('selfPage');
        }

        if (session()->has('no_create_user')) {
            session()->forget('no_create_user');
        }
    }
}
