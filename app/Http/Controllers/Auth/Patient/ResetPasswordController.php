<?php

namespace App\Http\Controllers\Auth\Patient;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::PATIENTHOME;

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        if (!$token) {
            return redirect("/patient/forgot-password")->with('error', Lang::get('passwords.token'));
        } else {
            $checkToken = DB::table('patient_password_resets')->where('email', $request->email)->first();
            // Jika token tidak ada
            if (!$checkToken) {
                return redirect("/patient/forgot-password")->with('error', Lang::get('passwords.token'));
            }
            // Jika token tidak valid
            if (!Hash::check($token, $checkToken->token)) {
                return redirect("/patient/forgot-password")->with('error', Lang::get('passwords.token'));
            }
            // Jika token expired
            if ($this->tokenExpired($checkToken->created_at)) {
                return redirect("/patient/forgot-password")->with('error', Lang::get('passwords.expired'));
            };

            return view('visitor.patient.auth.reset-password')->with(
                ['token' => $token, 'email' => $request->email]
            );
        }
    }

    /**
     * Determine if the token has expired.
     *
     * @param  string  $createdAt
     * @return bool
     */
    protected function tokenExpired($createdAt)
    {
        return Carbon::parse($createdAt)->addSeconds(config('auth.passwords.patients.expire') * 60)->isPast();
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('patients');
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('patient');
    }
}
