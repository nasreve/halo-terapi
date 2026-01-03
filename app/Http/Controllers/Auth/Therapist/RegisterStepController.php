<?php

namespace App\Http\Controllers\Auth\Therapist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Therapist\Register\PersonalDataRequest;
use App\Http\Requests\Therapist\Register\ExperienceRequest;
use App\Http\Requests\Therapist\Register\RegisterServiceRequest;
use App\Http\Traits\UploadTrait;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Service;
use App\Models\TherapistArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterStepController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $therapist = auth()->guard('therapist')->user();
            if ($therapist->step === 0) {
                return redirect()->route('therapist.order.history');
            }

            return $next($request);
        });
    }

    /**
     * Show step 2 registration
     *
     * @return Illuminate\View\View
     */
    public function step2()
    {
        $therapist = auth()->guard('therapist')->user();

        return view('visitor.therapist.auth.register.step-2', [
            'therapist' => $therapist,
            'provinces' => Province::all(),
            'regencies' => Regency::where('province_id', $therapist->province_id)->get(),
            'districts' => District::where('regency_id', $therapist->regency_id)->get(),
        ]);
    }

    /**
     * Menyimpan data step ke 2
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response|Illuminate\Http\RedirectResponse
     */
    public function step2submit(PersonalDataRequest $request)
    {
        $therapist = auth()->guard('therapist')->user();
        $therapist->update($request->validated() + [
            'step' => 3,
        ]);

        if ($request->hasFile('photo_path')) {
            $therapist->photo_name = $request->file('photo_path')->getClientOriginalName();
            $therapist->photo_path = $this->uploadFile($request->file('photo_path'));
            $therapist->save();
        }

        return $request->ajax()
            ? response()->json(['redirect' => route('therapist.register.step-3')], 200)
            : redirect()->route('therapist.register.step-3');
    }

    /**
     * Show step 3 registration
     *
     * @return Illuminate\View\View
     */
    public function step3()
    {
        if ($this->step3validation()->fails()) {
            return redirect()->route('therapist.register.step-2');
        }

        return view('visitor.therapist.auth.register.step-3', [
            'therapist' => auth()->guard('therapist')->user()
        ]);
    }

    /**
     * Memvalidasi step ke 2 lagi
     *
     * @return Illuminate\Support\Facades\Validator;
     */
    protected function step3validation()
    {
        $therapist = auth()->guard('therapist')->user();
        $request = new PersonalDataRequest();
        return Validator::make($therapist->toArray(), $request->rules(), $request->messages(), $request->attributes());
    }

    /**
     * Menyimpan data step ke 3
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response|Illuminate\Http\RedirectResponse
     */
    public function step3submit(ExperienceRequest $request)
    {
        $therapist = auth()->guard('therapist')->user();
        $therapist->update($request->validated() + [
            'step' => 4,
        ]);

        return $request->ajax()
            ? response()->json(['redirect' => route('therapist.register.step-4')], 200)
            : redirect()->route('therapist.register.step-4');
    }

    /**
     * Show step 4 registration
     *
     * @return Illuminate\View\View
     */
    public function step4()
    {
        if ($this->step4validation()->fails()) {
            return redirect()->route('therapist.register.step-3');
        }

        return view('visitor.therapist.auth.register.step-4', [
            'services' => Service::all(),
            'regencies' => Regency::take(5)->get()
        ]);
    }

    /**
     * Memvalidasi step ke 3 lagi
     *
     * @return Illuminate\Support\Facades\Validator;
     */
    protected function step4validation()
    {
        $therapist = auth()->guard('therapist')->user();
        $request = new ExperienceRequest();
        return Validator::make($therapist->toArray(), $request->rules(), $request->messages(), $request->attributes());
    }


    /**
     * Menyimpan data step ke 4
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function step4submit(RegisterServiceRequest $request)
    {
        try {
            $therapist = auth()->guard('therapist')->user();
            $therapist->update($request->validated() + [
                'step' => 0,
            ]);

            foreach ($request->service_id as $index => $service_id) {
                $therapist->services()->attach([$service_id => [
                    'rate' => str_replace(".", "", $request->rate[$index])
                ]]);
            }

            foreach ($request->regency as $index => $regency) {
                TherapistArea::create([
                    'therapist_id' => $therapist->id,
                    'regency_id' => $regency,
                    'district_id' => $request->district[$index]
                ]);
            }

            session()->flash('register_status', 'success');

            return response()->json([
                'redirect' => route('therapist.order.history')
            ]);
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(['message' => Lang::get('general.error')], 500);
        }
    }
}
