<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Step3Request;
use App\Http\Services\FormWizardService;
use App\Http\Services\OrderService;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Province;
use App\Models\Referrer;
use App\Models\Regency;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Therapist;
use App\Notifications\AdminOrderNotification;
use App\Notifications\PatientOrderNotification;
use App\Notifications\TherapistOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TherapistController extends Controller
{
    /**
     * Menampilkan halaman profil terapis
     *
     * @param  Illuminate\Http\Request $request
     * @param  string $username
     * @return void
     */
    public function view(Request $request, $username)
    {
        if ($this->saveReferralCodeToSession($request, $username)) {
            return redirect()->route('therapist.profile', $username);
        };

        if (!session()->has('therapistOrder'))
            session(['therapistOrder' => collect()]);

        if (!session()->has('therapistPages')) {
            session(['therapistPages' => [
                'username' => $username,
                'page' => 1
            ]]);
        }

        $this->checkTherapistExist($username);

        $this->saveServicePageToSession($request);

        $therapist = Therapist::where('username', $username)
            ->where('status', 'Disetujui')
            ->with(['services' => function ($query) {
                $query->wherePivot('status', 'Diterima')->get();
            }])
            ->first();

        $this->deleteOrderByUsername($username);

        return view('visitor.therapist.profile.index', [
            'therapist' => $therapist,
            'selectedService' => $therapist->services->whereIn('id', session('therapistOrder')->where('username', $username)->pluck('service_id')),
            'servicePage' => session('therapistPages')['username'] == $username ? session('therapistPages')['page'] : 1
        ]);
    }

    /**
     * Menyimpan code referral di session jika kondisi sesuai
     *
     * @param  Illuminate\Http\Request $request
     * @param  string $username
     * @return bool
     */
    protected function saveReferralCodeToSession(Request $request, $username)
    {
        if ($request->has('ref')) {
            $therapist = Therapist::where('username', $username)->first();

            if ($therapist && $therapist->referrer->unique_reff == $request->ref && $therapist->referrer->blocked !== 1) {
                session(['referral_code' => $request->ref]);
            }

            return true;
        }

        return false;
    }

    /**
     * Menyimpan data halaman pagination
     * ke session
     *
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    public function saveServicePageToSession(Request $request)
    {
        if (!$request->has('page')) {
            return false;
        }

        return session(['therapistPages' => [
            'username' => $request->username,
            'page' => $request->page
        ]]);
    }

    /**
     * Menyimpan layanan yang di pilih ke session
     *
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    public function order(Request $request)
    {
        $collection = session('therapistOrder');

        if ($collection->where('username', $request->username)->where('service_id', $request->service_id)->count() === 0) {
            $collection->push([
                'service_id' => $request->service_id,
                'username' => $request->username
            ]);

            session(['therapistOrder' => $collection]);
        } else {
            $filtered = $collection->filter(function ($value, $key) use ($request) {
                return $value['service_id'] != $request->service_id || $value['username'] != $request->username;
            });

            session(['therapistOrder' => $filtered]);
        }
    }

    /**
     * Menampilkan step 2 order dari profile terapis
     *
     * @return void
     */
    public function step2($username)
    {
        if (!session()->has('therapistOrder'))
            return abort(404);

        if (!session()->has('step2data'))
            session(['step2data' => new Order()]);

        $this->checkTherapistExist($username);

        $this->deleteOrderByUsername($username);

        $provinces = Province::all();

        $province = Province::where('name', session('step2data')->buyer_province)->first();
        $regency = Regency::where('name', session('step2data')->buyer_regency)->first();

        $provinceId = session('step2data')->buyer_province
            ? optional($province)->id
            : auth()->guard('patient')->user()->province_id;

        $regencyId = session('step2data')->hasAttribute('buyer_regency')
            ? optional($regency)->id
            : auth()->guard('patient')->user()->regency_id;

        $regencies = Regency::where('province_id', $provinceId)->get();
        $districts = District::where('regency_id', $regencyId)->get();

        return view('visitor.patient.order.via-profile.step-2', compact('provinces', 'regencies', 'districts') + [
            'jobs' => FormWizardService::jobData()
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
        $step2data = new Order($request->all());

        session(['step2data' => $step2data]);
    }

    /**
     * Validasi step ke 2
     *
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    public function step2submits(Step3Request $request, $username)
    {
        return response()->json(['redirect' => route('order.profile.step-3', $username)]);
    }

    /**
     * Menampilkan halaman step ke 3
     *
     * @param  string $username
     * @return void
     */
    public function step3(Request $request, $username)
    {
        if (!session()->has('step2data'))
            return abort(404);

        if ($this->step3validation()->fails()) {
            return redirect()->route('order.profile.step-2', $username);
        }

        $this->checkTherapistExist($username);
        $this->deleteOrderByUsername($username);
        $this->deleteService($request);

        return view('visitor.patient.order.via-profile.step-3', [
            'step2data' => session('step2data'),
            'services' => Service::whereIn('id', session('therapistOrder')->pluck('service_id'))->get(),
            'therapist' => Therapist::where('username', $username)->first(),
            'totalPrice' => OrderService::totalPriceProfileOrder($username),
            'setting' => Setting::first()
        ]);
    }

    /**
     * Validasi step ke 3
     *
     * @return Illuminate\Support\Facades\Validator
     */
    protected function step3validation()
    {
        $request = new Step3Request();

        return Validator::make(session('step2data')->toArray(), $request->rules(), $request->messages(), $request->attributes());
    }

    /**
     * Menghapus data session yang berhubungan dengan layanan (service).
     *
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    protected function deleteService(Request $request)
    {
        if (!$request->has('service_id') && !$request->has('username')) {
            return false;
        }

        $therapistOrder = session('therapistOrder');

        $filteredTherapistOrder = $therapistOrder->filter(function ($value, $key) use ($request) {
            return $value['service_id'] != $request->service_id;
        });

        session([
            'therapistOrder' => $filteredTherapistOrder,
        ]);
    }

    /**
     * Menghapus data order jika pindah terapis
     *
     * @param  string $username
     * @return void
     */
    public function deleteOrderByUsername($username)
    {
        $therapistOrder = session('therapistOrder');

        $filteredTherapistOrder = $therapistOrder->filter(function ($value, $key) use ($username) {
            return $value['username'] == $username;
        });

        session([
            'therapistOrder' => $filteredTherapistOrder,
        ]);
    }

    /**
     * Menyimpan order ke database
     *
     * @param  string $username
     * @return Illuminate\Http\Response
     */
    public function step3Submits($username)
    {
        try {
            $order = Order::create(session('step2data')->toArray() + [
                'therapist_id' => Therapist::where('username', $username)->first()->id,
                'referrer_id' => OrderService::getReferrerId(),
                'order_id' => OrderService::generateOrderId(),
                'buyer_bank_name' => Setting::first()->bank_name,
                'buyer_account' => Setting::first()->bank_account,
                'buyer_account_number' => Setting::first()->account_number,
                'payment_status' => 'Belum Dibayar',
            ]);

            foreach (session('therapistOrder') as $therapistOrder) {
                $rate = FormWizardService::getTherapistRate($order->therapist_id, $therapistOrder['service_id']);
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'service' => Service::find($therapistOrder['service_id'])->title,
                    'rate' => $rate,
                    'therapist_fee' => FormWizardService::getTherapistFee($rate),
                    'vendor_fee' => FormWizardService::getVendorFee($rate, $order->referrer_id),
                    'referrer_fee' => null
                ]);

                $order->update([
                    'transaction_amount' => $order->transaction_amount + $orderItem->rate
                ]);
            }

            FormwizardService::sendEmail($order);

            return response()->json([
                'message' => 'Data berhasil disimpan ke database.',
                'redirect' => route('order.profile.success', $username)
            ], 200);
        } catch (\Throwable $th) {
            // return response()->json(['message' => $th->getMessage()], 500);
            return response()->json(['message' => Lang::get('general.error')], 500);
        }
    }

    /**
     * order success
     *
     * @return void
     */
    public function success()
    {
        FormWizardService::resetAllSessionTherapist();

        return view('visitor.patient.order.success');
    }

    /**
     * Middleware
     *
     * @param  string $username
     * @return void
     */
    protected function checkTherapistExist($username)
    {
        $therapist = Therapist::where('username', $username)
            ->where([
                'status' => 'Disetujui',
                'blocked' => 0
            ])
            ->first();

        if (!$therapist)
            return abort(404);
    }

    /**
     * Cek apakah cart kosong
     *
     * @return void
     */
    protected function isEmptyCart()
    {
        if (!session()->has('therapistOrder'))
            return abort(404);

        if (session('therapistOrder')->isEmpty())
            return abort(404);
    }

    /**
     * Mengambil referrer id dari session (jika ada)
     *
     * @return void
     */
    protected function getReferrerId()
    {
        if (session()->has('referral_code')) {
            return Referrer::where('unique_reff', session('referral_code'))->first()->id;
        }

        return null;
    }
}
