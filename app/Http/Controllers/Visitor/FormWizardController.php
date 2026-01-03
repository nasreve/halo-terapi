<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Step2Request;
use App\Http\Requests\Step3Request;
use App\Http\Services\FormWizardService;
use App\Http\Services\OrderService;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Therapist;
use App\Models\TherapistService;
use App\Notifications\AdminOrderNotification;
use App\Notifications\PatientOrderNotification;
use App\Notifications\TherapistOrderNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FormWizardController extends Controller
{
    /**
     * Menampilkan halaman step ke dua form wizard
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\View\View
     */
    public function step2(Request $request)
    {
        if (!session()->has('orderVisitor') || session('orderVisitor')->count() == 0) { // jika pasien tidak memilih layanan redirect kembali ke halaman home
            return redirect()->route('home');
        }

        FormWizardService::initSession();

        $this->therapistRegency($request);
        $this->therapistDistrict($request);
        $this->saveServicePageToSession($request);

        $services = collect();
        foreach (session('orderVisitor') as $orderVisitor) {
            $regency_id = FormwizardService::getRegencyId($orderVisitor['service_id']);
            $district_id = FormwizardService::getDistrictId($orderVisitor['service_id']);

            // dd($district_id);

            $service = Service::with(['therapists' => function ($query) use ($regency_id, $district_id) {
                $query
                    ->whereHas('therapistAreas', function ($query) use ($regency_id) {
                        $query->where('regency_id', $regency_id);
                    })
                    ->when($district_id, function ($query) use ($regency_id, $district_id) {
                        $query->whereHas('therapistAreas', function ($query) use ($regency_id, $district_id) {
                            $query->where('regency_id', $regency_id)
                                ->where('district_id', $district_id);
                        });
                    })
                    ->where('therapists.status', 'Disetujui')
                    ->where('therapists.blocked', '0')
                    ->wherePivot('status', 'Diterima')->get();
            }])->find($orderVisitor['service_id']);

            $services->push($service);
        }

        return view('visitor.patient.order.step-2', compact('services'));
    }

    /**
     * Validasi step ke 2
     *
     * @param  Step2Request $request
     * @return json
     */
    public function step2submits(Step2Request $request)
    {
        return response()->json(['redirect' => route('order.step-3')]);
    }

    /**
     * Menyimpan data terapis ke session agar
     * tidak hilang saat halaman di refresh
     *
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function chooseTherapist(Request $request)
    {
        try {
            $choosenTherapists = session('choosenTherapists');

            $filtered = $choosenTherapists->filter(function ($value, $key) use ($request) {
                return $value->service_id != $request->service_id;
            });

            $filtered->push(new TherapistService([
                'service_id' => $request->service_id,
                'therapist_id' => $request->therapist_id
            ]));

            return session(['choosenTherapists' => $filtered]);
        } catch (\Throwable $th) {
            // return response()->json(['message' => $th->getMessage()], 500);
            return response()->json(['message' => Lang::get('general.error')], 500);
        }
    }

    /**
     * Menyimpan data filter terapis berdasarkan
     * kabupaten ke session
     *
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function therapistRegency(Request $request)
    {
        if (!$request->has('regency_id')) {
            return false;
        }

        $this->resetServicePageSession($request, $request->service_id);

        if (session()->has('therapistDistricts')) { // menset value kecamatan ke empty jika ganti kabupaten
            $therapistDistricts = session('therapistDistricts');

            $filtered = $therapistDistricts->filter(function ($value, $key) use ($request) {
                return $value['service_id'] != $request->service_id;
            });

            $filtered->push([
                'service_id' => $request->service_id,
                'district_id' => ""
            ]);

            session(['therapistDistricts' => $filtered]);
        }

        $therapistRegencies = session('therapistRegencies');

        $filtered = $therapistRegencies->filter(function ($value, $key) use ($request) {
            return $value['service_id'] != $request->service_id;
        });

        $filtered->push([
            'service_id' => $request->service_id,
            'regency_id' => $request->regency_id
        ]);

        return session(['therapistRegencies' => $filtered]);
    }

    /**
     * Menyimpan data filter terapis berdasarkan
     * kecamatan ke session
     *
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function therapistDistrict(Request $request)
    {
        if (!$request->has('district_id')) {
            return false;
        }

        $this->resetServicePageSession($request, $request->service_id);

        $therapistDistricts = session('therapistDistricts');

        $filtered = $therapistDistricts->filter(function ($value, $key) use ($request) {
            return $value['service_id'] != $request->service_id;
        });

        $filtered->push([
            'service_id' => $request->service_id,
            'district_id' => $request->district_id
        ]);

        return session(['therapistDistricts' => $filtered]);
    }


    /**
     * Menyimpan data halaman pagination
     * ke session
     *
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function saveServicePageToSession(Request $request)
    {
        if (!$request->has('page')) {
            return false;
        }

        $servicePages = session('servicePages');

        $filtered = $servicePages->filter(function ($value, $key) use ($request) {
            return $value['service_id'] != $request->service_id;
        });

        $filtered->push([
            'service_id' => $request->service_id,
            'page' => $request->page
        ]);

        return session(['servicePages' => $filtered]);
    }

    /**
     * Mereset data page di session
     *
     * @param  Illuminate\Http\Request $request
     * @param  mixed $service_id
     * @return void
     */
    protected function resetServicePageSession(Request $request, $service_id)
    {
        $servicePages = session('servicePages');

        $filtered = $servicePages->filter(function ($value, $key) use ($request) {
            return $value['service_id'] != $request->service_id;
        });

        $filtered->push([
            'service_id' => $request->service_id,
            'page' => ""
        ]);

        return session(['servicePages' => $filtered]);
    }

    /**
     * Menampilkan halaman form wizard
     * step ke tiga
     *
     * @return void
     */
    public function step3()
    {
        if (!session()->has('choosenTherapists') || session('choosenTherapists')->count() != session('orderVisitor')->count())
            return redirect()->route('order.step-2');

        !session()->has('step3data') ? session(['step3data' => new Order([])]) : false;

        $provinces = Province::all();

        $province = Province::where('name', session('step3data')->buyer_province)->first();
        $regency = Regency::where('name', session('step3data')->buyer_regency)->first();

        $provinceId = session('step3data')->buyer_province
            ? optional($province)->id
            : auth()->guard('patient')->user()->province_id;

        $regencyId = session('step3data')->hasAttribute('buyer_regency')
            ? optional($regency)->id
            : auth()->guard('patient')->user()->regency_id;

        $regencies = Regency::where('province_id', $provinceId)->get();
        $districts = District::where('regency_id', $regencyId)->get();

        return view('visitor.patient.order.step-3', compact('provinces', 'regencies', 'districts') + [
            'jobs' => FormWizardService::jobData()
        ]);
    }

    /**
     * Validasi step ke 3
     *
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function step3submits(Step3Request $request)
    {
        return response()->json(['redirect' => route('order.step-4')]);
    }

    /**
     * Menyimpan data step ke 3 ke session
     *
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function step3Data(Request $request)
    {
        $step3data = new Order($request->all());

        session(['step3data' => $step3data]);
    }

    /**
     * Menampilkan step ke 4
     *
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function step4(Request $request)
    {
        if (!session()->has('choosenTherapists') || session('choosenTherapists')->count() != session('orderVisitor')->count())
            return redirect()->route('order.step-2');

        if ($this->step3validation()->fails()) {
            return redirect()->route('order.step-3');
        }

        $this->deleteService($request);

        $therapists = collect();
        $therapistServices = collect();
        $services = collect();

        foreach (session('choosenTherapists') as $therapist) {
            $therapists->push(Therapist::find($therapist['therapist_id']));
            $therapistServices->push(TherapistService::where([
                'therapist_id' => $therapist['therapist_id'],
                'service_id' => $therapist['service_id']
            ])->first());
            $services->push(Service::find($therapist['service_id']));
        }

        return view('visitor.patient.order.step-4', compact('therapists', 'services', 'therapistServices') + [
            'totalPrice' => FormwizardService::getTotalPrice(),
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

        return Validator::make(session('step3data')->toArray(), $request->rules(), $request->messages(), $request->attributes());
    }

    /**
     * Menghapus data session yang berhubungan dengan layanan (service).
     *
     * @param Illuminate\Http\Request $request
     * @return void
     */
    protected function deleteService(Request $request)
    {
        if (!$request->has('service_id') && !$request->has('therapist_id')) {
            return false;
        }

        $orderVisitor = session('orderVisitor');
        $servicePages = session('servicePages');
        $choosenTherapists = session('choosenTherapists');
        $therapistRegencies = session('therapistRegencies');
        $therapistDistricts = session('therapistDistricts');

        $filteredOrderVisitor = $orderVisitor->filter(function ($value, $key) use ($request) {
            return $value['service_id'] != $request->service_id;
        });

        $filteredServicePages = $servicePages->filter(function ($value, $key) use ($request) {
            return $value['service_id'] != $request->service_id;
        });

        $filteredChoosenTherapists = $choosenTherapists->filter(function ($value, $key) use ($request) {
            return $value->service_id != $request->service_id;
        });

        $filteredTherapistRegencies = $therapistRegencies->filter(function ($value, $key) use ($request) {
            return $value['service_id'] != $request->service_id;
        });

        $filteredTherapistDistricts = $therapistDistricts->filter(function ($value, $key) use ($request) {
            return $value['service_id'] != $request->service_id;
        });

        session([
            'orderVisitor' => $filteredOrderVisitor,
            'servicePages' => $filteredServicePages,
            'choosenTherapists' => $filteredChoosenTherapists,
            'therapistRegencies' => $filteredTherapistRegencies,
            'therapistDistricts' => $filteredTherapistDistricts
        ]);
    }

    /**
     * step4submit
     *
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function step4submits(Request $request)
    {
        try {
            $choosenTherapists = session('choosenTherapists');
            $sortedTherapist = $choosenTherapists->sortBy('therapist_id');

            $order_id = null;
            $therapist_prev_id = null;
            $orders = collect();

            foreach ($sortedTherapist as $choosenTherapist) {
                $therapist = Therapist::where([
                    'id' => $choosenTherapist->therapist_id,
                    'status' => 'Disetujui',
                    'blocked' => 0
                ])->firstOrFail();

                if (OrderService::checkServiceApprovedFZ($therapist, $choosenTherapist->service_id) === false) {
                    return response()->json(['status' => 'failed', 'message' => Lang::get('general.service.not-approved')], 500);
                };

                if ($therapist_prev_id != $choosenTherapist->therapist_id) {
                    $order = Order::create(session('step3data')->toArray() + [
                        'therapist_id' => $choosenTherapist->therapist_id,
                        'referrer_id' => OrderService::getReferrerId(),
                        'order_id' => OrderService::generateOrderId(),
                        'buyer_bank_name' => Setting::first()->bank_name,
                        'buyer_account' => Setting::first()->bank_account,
                        'buyer_account_number' => Setting::first()->account_number,
                        'payment_status' => 'Belum Dibayar',
                    ]);

                    $order_id = $order->id;
                    $therapist_prev_id = $choosenTherapist->therapist_id;

                    $orders->push($order);
                }

                $rate = FormWizardService::getTherapistRate($choosenTherapist->therapist_id, $choosenTherapist->service_id);
                $orderItem = OrderItem::create([
                    'order_id' => $order_id,
                    'service' => Service::find($choosenTherapist->service_id)->title,
                    'rate' => $rate,
                    'therapist_fee' => FormWizardService::getTherapistFee($rate),
                    'vendor_fee' => FormWizardService::getVendorFee($rate, $order->referrer_id),
                    'referrer_fee' => null
                ]);

                $order->update([
                    'transaction_amount' => $order->transaction_amount + $orderItem->rate
                ]);
            }

            $this->sendEmail($orders);

            return response()->json([
                'message' => 'Data berhasil disimpan ke database.',
                'redirect' => route('order.success')
            ], 200);
        } catch (ModelNotFoundException $th) {
            return response()->json(['status' => 'failed', 'message' => Lang::get('general.notavailable')], 500);
        } catch (\Throwable $th) {
            // return response()->json(['message' => $th->getMessage()], 500);
            return response()->json(['message' => Lang::get('general.error')], 500);
        }
    }

    /**
     * Mengirim email order ke admin
     * jika metode pembayaran transfer
     *
     * @param  mixed $data
     * @return void
     */
    protected function sendEmail($orders)
    {
        foreach ($orders as $order) {
            FormwizardService::sendEmail($order);
        }
    }

    /**
     * order success
     *
     * @return void
     */
    public function success()
    {
        FormWizardService::resetAllSession();

        return view('visitor.patient.order.success');
    }
}
