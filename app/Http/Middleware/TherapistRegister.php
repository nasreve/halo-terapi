<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TherapistRegister
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
        $patient = auth()->guard('therapist')->user();

        if ($patient->step === 1) {
            auth()->guard('therapist')->logout();
            return redirect()->route('therapist.verification.show', $patient->id);
        }

        if ($patient->step === 2) {
            return redirect()->route('therapist.register.step-2');
        }

        if ($patient->step === 3) {
            return redirect()->route('therapist.register.step-3');
        }

        if ($patient->step === 4) {
            return redirect()->route('therapist.register.step-4');
        }

        return $next($request);
    }
}
