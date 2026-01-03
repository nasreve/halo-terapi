<?php

namespace App\Http\Controllers\Auth\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after patient verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::PATIENTHOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        $patient = Patient::findOrFail($id);

        return $patient->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('visitor.patient.auth.email-verify');
    }

    /**
     * Mengirim email verifikasi
     *
     * @param  mixed $request
     * @return void
     */
    public function send(Request $request)
    {
        $patient = Patient::find($request->id);
        $patient->sendEmailVerificationNotification();
        return back()->with('success', Lang::get('auth.verification.sent'));
    }

    /**
     * Verifikasi email
     *
     * @param  mixed $id
     * @return void
     */
    public function verify($id)
    {
        $patient = Patient::findOrFail($id);

        if (!$patient->hasVerifiedEmail()) {
            $patient->markEmailAsVerified();

            event(new Verified($patient));
        }

        $this->guard()->login($patient);

        if ($patient->referrer()->exists()) {
            session()->flash('register_status', 'success');
            return redirect()->route('patient.referral.dashboard');
        }

        return redirect('/');
    }

    /**
     * guard
     *
     * @return object
     */
    public function guard(): object
    {
        return Auth::guard('patient');
    }
}
