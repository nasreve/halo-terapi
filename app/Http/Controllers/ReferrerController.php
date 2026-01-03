<?php

namespace App\Http\Controllers;

use App\Http\Services\BaseService;
use App\Http\Services\PatientService;
use App\Http\Services\ReferrerService;
use App\Models\Referrer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReferrerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.referrer.index');
    }

    /**
     * Mengambil data referrer untuk datatable
     *
     * @return json
     */
    public function listReferrer(Request $request)
    {
        $referrers = Referrer::get();

        $totalData = $referrers->count();

        $columns = [
            'id',
            'unique_reff',
            'name',
            'business_community',
            'regency',
            'source',
            'whatsapp_number',
            'blocked'
        ];

        $totalFiltered = $totalData;
        $orderColumn = $request->input('order.0.column');

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$orderColumn];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value')) && !$request->has('date_start')) {
            $referrers = $this->queryServerSider()
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $referrers = $this->queryServerSider()
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->where(function ($query) use ($search) {
                    $this->searchQuery($query, $search);
                })
                ->get();

            $allReferrers = $this->queryServerSider()
                ->orderBy($order, $dir)
                ->where(function ($query) use ($search) {
                    $this->searchQuery($query, $search);
                })
                ->get();

            $totalFiltered = $allReferrers->count();
        }

        $no = $start + 1;
        $data = array();
        foreach ($referrers as $referrer) {
            $detailUrl =  route('referrer.edit', $referrer->id);
            $deleteUrl = route('referrer.destroy', ['referrer' => $referrer->id]);

            $row = array();
            $row[]  = $no;
            $row[]  = $referrer->unique_reff;
            $row[]  = $referrer->name;
            $row[]  = $referrer->business_community;
            $row[]  = $referrer->regency;
            $row[]  = $referrer->source;
            $row[]  = BaseService::getPhoneNumber($referrer->whatsapp_number);
            $row[]  = BaseService::getAccountStatus($referrer->blocked);
            $row[]  = BaseService::getActionButton($referrer->id, $detailUrl, $deleteUrl);
            $data[] = $row;

            $no++;
        }

        return response()->json([
            "order"           => $start,
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data,
            "page"            => (intval($start) / 10),
        ]);
    }

    /**
     * Logic join table
     */
    protected function queryServerSider()
    {
        return Referrer::query()
            ->leftJoin('therapists', 'referrers.therapist_id', 'therapists.id')
            ->leftJoin('patients', 'referrers.patient_id', 'patients.id')
            ->leftJoin('regencies', function ($join) {
                $join
                    ->on('regencies.id', '=', 'patients.regency_id')
                    ->orOn('regencies.id', '=', 'therapists.regency_id');
            })
            ->select([
                'referrers.id',
                'referrers.unique_reff',
                DB::raw(
                    '(CASE WHEN tbr_referrers.patient_id IS NOT NULL THEN tbr_patients.name ELSE tbr_therapists.name END) as name'
                ),
                'referrers.business_community',
                'regencies.name as regency',
                DB::raw(
                    '(CASE WHEN tbr_referrers.patient_id IS NOT NULL THEN tbr_patients.source ELSE tbr_therapists.source END) as source'
                ),
                DB::raw(
                    '(CASE WHEN tbr_referrers.patient_id IS NOT NULL THEN tbr_patients.whatsapp_number ELSE tbr_therapists.whatsapp END) as whatsapp_number'
                ),
                'referrers.blocked'
            ]);
    }

    /**
     * Logic pencarian
     */
    protected function searchQuery($query, $search)
    {
        return $query
            ->where('referrers.unique_reff', 'LIKE', '%' . $search . '%')
            ->orWhereRaw(
                'CASE WHEN tbr_referrers.patient_id IS NOT NULL THEN tbr_patients.name ELSE tbr_therapists.name END LIKE "%' . $search . '%"'
            )
            ->orWhere('referrers.business_community', 'LIKE', '%' . $search . '%')
            ->orWhere('regencies.name', 'LIKE', '%' . $search . '%')
            ->orWhereRaw(
                'CASE WHEN tbr_referrers.patient_id IS NOT NULL THEN tbr_patients.source ELSE tbr_therapists.source END LIKE "%' . $search . '%"'
            )
            ->orWhereRaw(
                'CASE WHEN tbr_referrers.patient_id IS NOT NULL THEN tbr_patients.whatsapp_number ELSE tbr_therapists.whatsapp END LIKE "%' . $search . '%"'
            )
            ->when(strtolower($search) === "active", function ($query) use ($search) {
                $query->orWhere('referrers.blocked', 0);
            })
            ->when(strtolower($search) === "deactive", function ($query) use ($search) {
                $query->orWhere('referrers.blocked', 1);
            });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Referrer $referrer)
    {
        $referrer = Referrer::with('patient', 'therapist')->where('id', $referrer->id)->first();

        return view('admin.referrer.edit', compact('referrer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Referrer $referrer)
    {
        $request->validate([
            'referrer_status' => 'required'
        ], [
            'referrer_status.required' => 'Status referrer wajib untuk dipilih.'
        ]);

        try {
            $referrer->blocked = $request->referrer_status;
            $referrer->save();
            return response()->json(['message'  => 'Data berhasil diupdate.'], 200);
        } catch (\Throwable $th) {
            // return response()->json(['message'  => $th->getMessage()], 500);
            return response()->json(['message'  => 'Data gagal diupdate!'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Referrer $referrer)
    {
        try {
            $referrer->delete();
            return response()->json(['message'  => 'Data berhasil dihapus dari basis data.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message'  => 'Data gagal dihapus dari basis data.'], 500);
        }
    }
}
