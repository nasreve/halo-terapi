<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActiveTherapist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('therapist')->check()) {
            if (Auth::guard('therapist')->user()->blocked) {
                if ($request->ajax()) {
                    return response()->json([
                        'status' => 'blocked',
                        'message' => [
                            'error' => ['Akun Anda telah diblokir dari aplikasi ini
                                dikarenakan melanggar ketentuan yang
                                berlaku atau hal lainnya.']
                        ]
                    ], 404);
                }

                Auth::guard('therapist')->logout();
                return redirect('/therapist')
                    ->withError('Akun Anda telah diblokir dari aplikasi ini
                        dikarenakan melanggar ketentuan yang
                        berlaku atau hal lainnya.');
            }

            return $next($request);
        }

        return $next($request);
    }
}
