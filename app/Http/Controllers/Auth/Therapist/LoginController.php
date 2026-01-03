<?php

namespace App\Http\Controllers\Auth\Therapist;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Lang;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest:therapist')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('visitor.therapist.auth.login');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string|email|exists:therapists,email',
            'password' => 'required|string',
        ], [
            'email.exists' => 'Email tidak ditemukan dalam basis data kami.'
        ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->ajax()
            ? response()->json([
                'status' => 'success',
                'redirect' => route('therapist.order.history')
            ]) : redirect()->intended($this->redirectPath());
    }

    /**
     * redirectRoute
     *
     * @param  mixed $request
     * @return void
     */
    protected function redirectRoute(Request $request)
    {
        if ($request->username)
            return route('order.profile.step-2', $request->username);

        if ($request->cart)
            return route('order.step-2');

        return url()->previous();
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $cookieLifetime = 10080; // Seminggu
        Cookie::queue(Cookie::make('status', 'therapist', $cookieLifetime));

        $userNotVerified = !$this->guard()->user()->hasVerifiedEmail();
        if ($userNotVerified) {
            $id = $this->guard()->user()->id;
            $this->guard()->logout();
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'EmailNotVerified',
                    'redirect' => route('therapist.verification.show', $id)
                ], 401);
            }

            return redirect()->route('therapist.verification.show', $id);
        }

        $patientBlocked = $this->guard()->user()->blocked;
        if ($patientBlocked) {
            $id = $this->guard()->user()->id;
            $this->guard()->logout();

            session()->flash('blocked', 'true');

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'blocked',
                ], 401);
            }

            return back()->with('error', Lang::get('auth.blocked'));
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->route('therapist.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('therapist');
    }
}
