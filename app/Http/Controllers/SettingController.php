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
        return view('admin.setting.system', ['setting' => Setting::first()]);
    }

    /**
     * Update persentasi fee
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

            return response()->json(['message' => 'Data berhasil diupdate.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Data gagal diupdate.'], 500);
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
                'bank_name', 'bank_account', 'account_number'
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
