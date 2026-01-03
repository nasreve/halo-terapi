<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActiveUser
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
        if (Auth::User()->blocked) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'session_expired',
                    'message' => [
                        'error' => ['Akun Anda telah diblokir dari aplikasi ini
                            dikarenakan melanggar ketentuan yang
                            berlaku atau hal lainnya.']
                    ]
                ], 404);
            }

            Auth::logout();
            return redirect('admin')
                ->withError('Akun Anda telah diblokir dari aplikasi ini
                    dikarenakan melanggar ketentuan yang
                    berlaku atau hal lainnya.');
        }

        return $next($request);
    }
}
