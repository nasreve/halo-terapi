<?php

namespace App\Http\Controllers;

use App\Http\Services\BaseService;
use App\Http\Services\PatientService;
use App\Models\Patient;
use App\Models\Referrer;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.patient.index');
    }

    /**
     * Mengambil data pasien untuk datatable
     *
     * @return json
     */
    public function listPatient(Request $request)
    {
        $patients = Patient::get();

        $totalData = $patients->count();

        $columns = [
            'id',
            'name',
            'date_of_birth',
            'job',
            'regency',
            'source',
            'whatsapp_number',
            'status'
        ];

        $totalFiltered = $totalData;
        $orderColumn = $request->input('order.0.column');

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$orderColumn];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value')) && !$request->has('date_start')) {
            $patients = $this->queryServerSider()
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $patients = $this->queryServerSider()
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->where(function ($query) use ($search) {
                    $this->searchQuery($query, $search);
                })
                ->get();

            $allPatients = $this->queryServerSider()
                ->orderBy($order, $dir)
                ->where(function ($query) use ($search) {
                    $this->searchQuery($query, $search);
                })
                ->get();

            $totalFiltered = $allPatients->count();
        }

        $no = $start + 1;
        $data = array();
        foreach ($patients as $patient) {
            $detailUrl =  route('patient.edit', $patient['id']);
            $deleteUrl = route('patient.destroy', ['patient' => $patient['id']]);

            $row = array();
            $row[]  = $no;
            $row[]  = $patient['name'];
            $row[]  = ageFormat($patient['date_of_birth']);
            $row[]  = $patient['job'];
            $row[]  = $patient['regency'];
            $row[]  = $patient['source'];
            $row[]  = BaseService::getPhoneNumber($patient['whatsapp_number']);
            $row[]  = BaseService::getAccountStatus($patient['status']);
            $row[]  = BaseService::getActionButton($patient['id'], $detailUrl, $deleteUrl);
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
        return Patient::query()
            ->leftJoin('regencies', 'patients.regency_id', 'regencies.id')
            ->select([
                'patients.id',
                'patients.name',
                'patients.date_of_birth',
                'patients.job',
                'regencies.name as regency',
                'patients.source',
                'patients.whatsapp_number',
                'patients.blocked as status'
            ]);
    }

    /**
     * Logic pencarian
     */
    protected function searchQuery($query, $search)
    {
        return $query
            ->orWhere('patients.name', 'LIKE', '%' . $search . '%')
            ->when(is_numeric($search), function ($query) use ($search) {
                $query->orWhere('patients.date_of_birth', 'LIKE', '%' . getDOB($search) . '%');
            })
            ->orWhere('patients.job', 'LIKE', '%' . $search . '%')
            ->orWhere('regencies.name', 'LIKE', '%' . $search . '%')
            ->orWhere('patients.source', 'LIKE', '%' . $search . '%')
            ->orWhere('patients.whatsapp_number', 'LIKE', '%' . $search . '%')
            ->when(strtolower($search) === "active", function ($query) use ($search) {
                $query->orWhere('patients.blocked', 0);
            })
            ->when(strtolower($search) === "deactive", function ($query) use ($search) {
                $query->orWhere('patients.blocked', 1);
            });
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return view('admin.patient.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'patient_status' => 'required'
        ], [
            'patient_status.required' => 'Status pemesanan wajib untuk dipilih.'
        ]);

        try {
            $patient->blocked = $request->patient_status;
            $patient->save();
            return response()->json(['message'  => 'Data berhasil diupdate.'], 200);
        } catch (\Throwable $th) {
            // return response()->json(['message'  => $th->getMessage()], 500);
            return response()->json(['message'  => 'Data gagal diupdate!'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        try {
            $patient->referrer()->delete();
            $patient->delete();
            return response()->json(['message'  => 'Data berhasil dihapus dari basis data.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message'  => 'Data gagal dihapus dari basis data.'], 500);
        }
    }
}
