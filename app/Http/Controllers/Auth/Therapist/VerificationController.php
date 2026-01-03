<?php

namespace App\Http\Controllers\Auth\Therapist;

use App\Http\Controllers\Controller;
use App\Models\Therapist;
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
    protected $redirectTo = RouteServiceProvider::THERAPISTHOME;

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
        $therapist = Therapist::findOrFail($id);

        return $therapist->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('visitor.therapist.auth.register.email-verify');
    }

    /**
     * Mengirim email verifikasi
     *
     * @param  mixed $request
     * @return void
     */
    public function send(Request $request)
    {
        $therapist = Therapist::find($request->id);
        $therapist->sendEmailVerificationNotification();
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
        $therapist = Therapist::findOrFail($id);

        if (!$therapist->hasVerifiedEmail()) {
            $therapist->markEmailAsVerified();

            event(new Verified($therapist));

            $therapist->update(['step' => 2]);
        }

        $this->guard()->login($therapist);
        return redirect()->route('therapist.order.history');
    }

    /**
     * Custom guard
     *
     * @return object
     */
    public function guard(): object
    {
        return Auth::guard('therapist');
    }
}