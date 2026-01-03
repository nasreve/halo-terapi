<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;

class RegencyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function filterByProvince($id)
    {
        $regency = Regency::where('province_id', $id)->get();
        return response()->json($regency);
    }

    /**
     * Memfilter kabupaten berdasarkan nama provinsi
     *
     * @param  mixed $name
     * @return void
     */
    public function filterByProvinceName($name)
    {
        $province = Province::where('name', $name)->first();

        $regency = Regency::where('province_id', optional($province)->id)->get();
        return response()->json($regency);
    }

    /**
     * filterByName
     *
     * @param  mixed $name
     * @return void
     */
    public function all(Request $request)
    {
        $regency = Regency::where('name', 'LIKE', '%' . $request->search . '%')->take(5)->get();
        return response()->json($regency);
    }
}
