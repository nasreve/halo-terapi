<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\SettingRequest;
use App\Http\Services\FormWizardService;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    /**
     * Menampilkan halaman pengaturan pasien
     *
     * @return view
     */
    public function index()
    {
        $patient = auth()->guard('patient')->user();

        return view('visitor.patient.setting.index', [
            'patient' => $patient,
            'jobs' => FormWizardService::jobData(),
            'provinces' => Province::all(),
            'regencies' => Regency::where('province_id', $patient->province_id)->get(),
            'districts' => District::where('regency_id', $patient->regency_id)->get()
        ]);
    }

    /**
     * Update patient setting
     *
     * @param  mixed $request
     * @return void
     */
    public function update(SettingRequest $request)
    {
        $request->shouldNotUpdate();

        try {
            $patient = auth()->guard('patient')->user();
            $patient->update($request->validated());

            if ($patient->referrer()->exists()) {
                $patient->referrer->update($request->only([
                    'business_community',
                    'business_name',
                    'business_address',
                ]));
            }

            if ($request->password != null) {
                $patient->password = Hash::make($request->password);
                $patient->save();
            }

            return response()->json(['message' => 'Anda telah berhasil melakukan update data.'], 200);
        } catch (\Throwable $th) {
            // return response()->json(['message' => $th->getMessage()], 500);
            return response()->json(['message' => 'Anda gagal dalam melakukan update data.'], 500);
        }
    }
}
