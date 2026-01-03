<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Therapist\Setting\AccountRequest;
use App\Http\Requests\Therapist\Setting\ExperienceRequest;
use App\Http\Requests\Therapist\Setting\PersonalDataRequest;
use App\Http\Requests\Therapist\Setting\ServiceRequest;
use App\Http\Traits\UploadTrait;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Service;
use App\Models\Therapist;
use App\Models\TherapistArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    use UploadTrait;

    /**
     * Menampilkan halaman setting terapis
     *
     * @return void
     */
    public function show()
    {
        $therapist = auth()->guard('therapist')->user();

        return view('visitor.therapist.setting.index', [
            'therapist' => $therapist,
            'provinces' => Province::all(),
            'regencies' => Regency::where('province_id', $therapist->province_id)->get(),
            'districts' => District::where('regency_id', $therapist->regency_id)->get(),
            'services' => Service::all()
        ]);
    }

    /**
     * Update data diri terapis
     *
     * @param  mixed $request
     * @return json
     */
    public function updatePersonalData(PersonalDataRequest $request)
    {
        $request->shouldNotUpdate();

        $therapist = auth()->guard('therapist')->user();

        try {
            $therapist->update($request->validated());

            if ($therapist->referrer()->exists()) {
                $therapist->referrer->update($request->only([
                    'business_community',
                    'business_name',
                    'business_address',
                ]));
            }

            if ($request->password != null) {
                $therapist->password = Hash::make($request->password);
                $therapist->save();
            }

            return response()->json(['message' => 'Anda telah berhasil melakukan update data.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Anda gagal dalam melakukan update data.'], 500);
        }
    }

    /**
     * Update data pengalaman terapis
     *
     * @param  mixed $request
     * @return json
     */
    public function updateExperience(ExperienceRequest $request)
    {
        $therapist = auth()->guard('therapist')->user();

        try {
            $therapist->update($request->validated());

            return response()->json(['message' => 'Anda telah berhasil melakukan update data.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'failed', 'message' => 'Anda gagal dalam melakukan update data.'], 500);
        }
    }

    /**
     * Update data layanan
     *
     * @param  mixed $request
     * @return void
     */
    public function updateService(ServiceRequest $request)
    {
        $therapist = auth()->guard('therapist')->user();

        try {
            $therapist->update($request->validated());

            $therapist->services()->sync($request->service_id);

            $therapist->therapistAreas()->delete();
            foreach ($request->regency as $index => $regency) {
                TherapistArea::create([
                    'therapist_id' => $therapist->id,
                    'regency_id' => $regency,
                    'district_id' => $request->district[$index]
                ]);
            }

            return response()->json(['message' => 'Anda telah berhasil melakukan update data.'], 200);
        } catch (\Throwable $th) {
            // return response()->json(['status' => 'failed', 'message' => $th->getMessage()], 500);
            return response()->json(['status' => 'failed', 'message' => 'Anda gagal dalam melakukan update data.'], 500);
        }
    }

    /**
     * Update data waktu layanan
     *
     * @param  mixed $request
     * @return void
     */
    public function updateHomecare(Request $request)
    {
        $request->validate(['homecare' => 'required'], [], ['homecare' => 'waktu pelayanan']);

        $therapist = auth()->guard('therapist')->user();

        try {
            $therapist->update(['homecare' => $request->homecare]);

            return response()->json(['message' => 'Anda telah berhasil melakukan update data.'], 200);
        } catch (\Throwable $th) {
            // return response()->json(['status' => 'failed', 'message' => $th->getMessage()], 500);
            return response()->json(['status' => 'failed', 'message' => 'Anda gagal dalam melakukan update data.'], 500);
        }
    }

    /**
     * Update data rekening
     *
     * @param  mixed $request
     * @return void
     */
    public function updateAccount(AccountRequest $request)
    {
        $therapist = auth()->guard('therapist')->user();

        try {
            $therapist->update($request->validated());

            return response()->json(['message' => 'Anda telah berhasil melakukan update data.'], 200);
        } catch (\Throwable $th) {
            // return response()->json(['message' => $th->getMessage()], 500);
            return response()->json(['message' => 'Anda gagal dalam melakukan update data.'], 500);
        }
    }

    /**
     * Update photo profile terapis
     *
     * @param  mixed $request
     * @return void
     */
    public function updatePhoto(Request $request)
    {
        $therapist = auth()->guard('therapist')->user();

        try {
            if ($request->hasFile('photo_path')) {
                $therapist->photo_name = $request->file('photo_path')->getClientOriginalName();
                $therapist->photo_path = $this->uploadFile($request->file('photo_path'));
                $therapist->save();
            }

            return response()->json(['message' => 'Anda telah berhasil melakukan update data.'], 200);
        } catch (\Throwable $th) {
            // return response()->json(['status' => 'failed', 'message' => $th->getMessage()], 500);
            return response()->json(['status' => 'failed', 'message' => 'Anda gagal dalam melakukan update data.'], 500);
        }
    }
}
