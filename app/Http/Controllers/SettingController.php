<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Http\Requests\FeeRequest;
use App\Http\Requests\MyProfileRequest;
use App\Http\Traits\UploadTrait;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    use UploadTrait;

    /**
     * Menampilkan halaman my profile
     *
     * @return void
     */
    public function showMyProfileForm()
    {
        return view('admin.setting.my-profile');
    }

    /**
     * Update data profile
     *
     * @param  mixed $request
     * @return void
     */
    public function updateMyProfile(MyProfileRequest $request)
    {
        try {
            $user = User::find(auth()->user()->id);
            $user->fill($request->validated());
            $this->updatePassword($request->password, $user);
            $user->save();

            return response()->json(['message' => 'Data berhasil diupdate.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Data gagal diupdate.'], 500);
        }
    }

    /**
     * Logic update password
     *
     * @param  mixed $password
     * @param  mixed $user
     * @return void
     */
    private function updatePassword($password, User $user)
    {
        if ($password) {
            return $user->password = Hash::make($password);
        }

        return false;
    }

    /**
     * Menampilkan halaman system
     *
     * @return void
     */
    public function showSystemForm()
    {
        return view('admin.setting.system', [
            'setting' => Setting::first(),
            'services' => \App\Models\Service::all()
        ]);
    }

    /**
     * Update persentase fee
     *
     * @param  mixed $request
     * @return void
     */
    public function updateFee(FeeRequest $request)
    {
        $request->is100Percent();

        try {
            $setting = Setting::first();
            $setting->update($request->validated());

            // Also update the toggle if it's included in the form
            if ($request->has('is_service_fee_form')) {
                $setting->update([
                    'use_service_fee_nominal' => (bool) $request->input('use_service_fee_nominal', 0)
                ]);
            }

            return response()->json(['message' => 'Data berhasil diupdate.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Data gagal diupdate.'], 500);
        }
    }

    public function updateNominalFee(Request $request)
    {
        try {
            $setting = Setting::first();

            // Update the toggle setting if this is a service fee form submission
            if ($request->has('is_service_fee_form')) {
                // The form sends use_service_fee_nominal=1 when nominal mode is active
                // If the field is present and has value "1" or truthy, set to true
                // Otherwise (including when not present), we don't change it unless explicitly set
                if ($request->has('use_service_fee_nominal')) {
                    $setting->update([
                        'use_service_fee_nominal' => (bool) $request->input('use_service_fee_nominal')
                    ]);
                }
            }

            // Update service prices and commissions
            $services = $request->input('services', []);

            // Validate: commission should not be greater than price
            foreach ($services as $id => $data) {
                $price = (int) str_replace('.', '', $data['price'] ?? 0);
                $commission = (int) str_replace('.', '', $data['therapist_commission'] ?? 0);

                if ($commission > $price) {
                    $service = \App\Models\Service::find($id);
                    $serviceName = $service ? $service->title : "ID $id";
                    return response()->json([
                        'message' => "Komisi terapis untuk layanan \"$serviceName\" tidak boleh lebih besar dari harga jual."
                    ], 422);
                }
            }

            // Save services after validation passes
            foreach ($services as $id => $data) {
                $service = \App\Models\Service::find($id);
                if ($service) {
                    $service->update([
                        'price' => (int) str_replace('.', '', $data['price'] ?? 0),
                        'therapist_commission' => (int) str_replace('.', '', $data['therapist_commission'] ?? 0)
                    ]);
                }
            }

            return response()->json(['message' => 'Data berhasil diupdate.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Data gagal diupdate. ' . $th->getMessage()], 500);
        }
    }

    /**
     * Update akun bank
     *
     * @param  mixed $request
     * @return void
     */
    public function updateAccount(AccountRequest $request)
    {
        try {
            $setting = Setting::first();
            $setting->update($request->only([
                'bank_name',
                'bank_account',
                'account_number'
            ]));

            if ($request->hasFile('logo_path')) {
                $setting->update([
                    'logo_path' => $this->uploadFile($request->file('logo_path')),
                    'logo_name' => $request->file('logo_path')->getClientOriginalName()
                ]);
            }

            return response()->json(['message' => 'Data berhasil diupdate.'], 200);
        } catch (\Throwable $th) {
            // return response()->json(['message' => $th->getMessage()], 500);
            return response()->json(['message' => 'Data gagal diupdate.'], 500);
        }
    }

    /**
     * Update transport note
     *
     * @param  mixed $request
     * @return void
     */
    public function updateTransport(Request $request)
    {
        $request->validate([
            'transport_note' => 'required'
        ], [], [
            'transport_note' => 'biaya transport'
        ]);

        try {
            $setting = Setting::first();
            $setting->update([
                'transport_note' => $request->transport_note
            ]);

            return response()->json(['message' => 'Data berhasil diupdate.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Data gagal diupdate.'], 500);
        }
    }
}
