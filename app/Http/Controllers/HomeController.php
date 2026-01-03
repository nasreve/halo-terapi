<?php

namespace App\Http\Controllers;

use App\Http\Session\Order;
use App\Models\OrderItem;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Lang;

class HomeController extends Controller
{
    /**
     * Show the application landing page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // session()->flush();

        if (!auth()->guard('patient')->check() && Cookie::get('status') === 'patient') {
            Cookie::queue(Cookie::forget('status'));
            session()->flash('sessionExpired', 'true');
            return redirect()->guest(route('home'));
        }

        return view('visitor.landing', [
            'services' => Service::all(),
            'selectedService' => Service::whereIn('id', session('orderVisitor') ?? collect())->get()
        ]);
    }

    /**
     * Menyimpan order ke session
     *
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    public function order(Request $request)
    {
        try {
            if (!session()->has('orderVisitor')) {
                session(['orderVisitor' => collect()]);
            }

            $collection = session('orderVisitor');
            if ($collection->where('service_id', $request->service_id)->count() === 0) {
                $collection->push([
                    'service_id' => $request->service_id
                ]);
                session(['orderVisitor' => $collection]);
            } else {
                $filtered = $collection->filter(function ($value, $key) use ($request) {
                    return $value['service_id'] != $request->service_id;
                });

                $this->resetToDefault($request);

                session(['orderVisitor' => $filtered]);
            }

            return response()->json(['status' => 'success'], 200);
        } catch (\Throwable $th) {
            // return response()->json(['status' => $th->getMessage()], 500);
            return response()->json(['status' => Lang::get('general.error')], 500);
        }
    }

    /**
     * Jika pasien tidak jadi memilih layanan update data session
     *
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    public function resetToDefault(Request $request)
    {
        if (session()->has('choosenTherapists')) {
            $filteredChoosenTherapists = session('choosenTherapists')->filter(function ($value, $key) use ($request) {
                return $value->service_id != $request->service_id;
            });

            session(['choosenTherapists' => $filteredChoosenTherapists]);
        }

        if (session()->has('therapistRegencies')) {
            $filteredTherapistRegencies = session('therapistRegencies')->filter(function ($value, $key) use ($request) {
                return $value['service_id'] != $request->service_id;
            });

            session(['therapistRegencies' => $filteredTherapistRegencies]);
        }

        if (session()->has('therapistDistricts')) {
            $filteredTherapistDistricts = session('therapistDistricts')->filter(function ($value, $key) use ($request) {
                return $value['service_id'] != $request->service_id;
            });

            session(['therapistDistricts' => $filteredTherapistDistricts]);
        }

        if (session()->has('servicePages')) {
            $filteredServicePages = session('servicePages')->filter(function ($value, $key) use ($request) {
                return $value['service_id'] != $request->service_id;
            });

            session(['servicePages' => $filteredServicePages]);
        }
    }
}
