<?php

namespace App\Exceptions;

use ErrorException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Lang;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof TokenMismatchException) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'session_expired',
                    'message' => 'Sesi Anda telah kadaluarsa dikarenakan tidak ada aktivitas permintaan terhadap sistem.'
                ], 419);
            }

            session()->flash('sessionExpired', 'true');
            return redirect('/');
        }

        return parent::render($request, $exception);
    }

    /**
     * unauthenticated
     *
     * @param  mixed $request
     * @param  mixed $exception
     * @return void
     */
    public function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->ajax()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        if (Cookie::get('status') === 'admin') {
            Cookie::queue(Cookie::forget('status'));
            return redirect()
                ->guest('/admin')
                ->with('error', 'Sesi Anda telah kedaluwarsa dikarenakan tidak ada aktivitas
                    permintaan terhadap sistem.');
        }

        if (Cookie::get('status') === 'therapist') {
            Cookie::queue(Cookie::forget('status'));
            return redirect()
                ->guest('/therapist')
                ->with('error', 'Sesi Anda telah kedaluwarsa dikarenakan tidak ada aktivitas
                    permintaan terhadap sistem.');
        }

        if (Cookie::get('status') === 'patient') {
            Cookie::queue(Cookie::forget('status'));
            session()->flash('sessionExpired', 'true');
            return redirect()->guest('/');
        }

        if ($request->is('admin/*')) {
            return redirect()->guest('/admin');
        }

        if ($request->is('therapist/*')) {
            return redirect()->guest('/therapist');
        }

        if ($request->is('patient/*')) {
            return redirect()->guest('/');
        }

        return redirect()->guest(route('login.form'));
    }
}
