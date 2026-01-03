<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Regency;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterByRegency($id)
    {
        $district = District::where('regency_id', $id)->get();
        return response()->json($district);
    }

    /**
     * Memfilter kecamatan berdasarakan name kabupaten
     *
     * @param  mixed $name
     * @return void
     */
    public function filterByRegencyName($name)
    {
        $regency = Regency::where('name', $name)->first();

        $district = District::where('regency_id', optional($regency)->id)->get();
        return response()->json($district);
    }
}
