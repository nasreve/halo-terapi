<?php

namespace App\Http\Controllers;

use App\Http\Requests\therapistRequest;
use App\Http\Services\BaseService;
use App\Http\Services\TherapistService;
use App\Models\Therapist;
use App\Notifications\TherapistRegisterNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TherapistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.therapist.index');
    }

    /**
     * Get therapist data for datatable.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $therapists = Therapist::get();

        $totalData = $therapists->count();

        $columns = [
            'id',
            'name',
            'regency',
            'source',
            'whatsapp',
            'status',
            'blocked'
        ];

        $totalFiltered = $totalData;
        $orderColumn = $request->input('order.0.column');

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$orderColumn];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value')) && !$request->has('date_start')) {
            $therapists = $this->queryServerSider()
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $therapists = $this->queryServerSider()
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->where(function ($query) use ($search) {
                    $this->searchQuery($query, $search);
                })
                ->get();

            $allTherapists = $this->queryServerSider()
                ->orderBy($order, $dir)
                ->where(function ($query) use ($search) {
                    $this->searchQuery($query, $search);
                })
                ->get();

            $totalFiltered = $allTherapists->count();
        }

        $no = $start + 1;
        $data = array();
        foreach ($therapists as $therapist) {
            $detailUrl =  route('therapist.edit', $therapist->id);
            $deleteUrl = route('therapist.destroy', ['therapist' => $therapist->id]);

            $row = array();
            $row[]  = $no;
            $row[]  = $therapist->name;
            $row[]  = TherapistService::getaddress($therapist->district, $therapist->regency);
            $row[]  = $therapist->source;
            $row[]  = BaseService::getPhoneNumber($therapist->whatsapp);
            $row[]  = TherapistService::getTherapistStatus($therapist->status);
            $row[]  = BaseService::getAccountStatus($therapist->blocked);
            $row[]  = BaseService::getActionButton($therapist->id, $detailUrl, $deleteUrl);
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
        return Therapist::query()
            ->leftJoin('regencies', 'therapists.regency_id', 'regencies.id')
            ->leftJoin('districts', 'therapists.district_id', 'districts.id')
            ->select([
                'therapists.id',
                'therapists.name',
                'districts.name as district',
                'regencies.name as regency',
                'therapists.source',
                'therapists.whatsapp',
                'therapists.status',
                'therapists.blocked'
            ]);
    }

    /**
     * Logic pencarian
     */
    protected function searchQuery($query, $search)
    {
        return $query
            ->orWhere('therapists.name', 'LIKE', '%' . $search . '%')
            ->orWhere('regencies.name', 'LIKE', '%' . $search . '%')
            ->orWhere('districts.name', 'LIKE', '%' . $search . '%')
            ->orWhere('therapists.source', 'LIKE', '%' . $search . '%')
            ->orWhere('therapists.whatsapp', 'LIKE', '%' . $search . '%')
            ->orWhere('therapists.status', 'LIKE', '%' . $search . '%')
            ->when(strtolower($search) === "active", function ($query) use ($search) {
                $query->orWhere('therapists.blocked', 0);
            })
            ->when(strtolower($search) === "deactive", function ($query) use ($search) {
                $query->orWhere('therapists.blocked', 1);
            });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Therapist  $therapist
     * @return \Illuminate\Http\Response
     */
    public function show(Therapist $therapist)
    {
        return view('admin.therapist.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Therapist  $therapist
     * @return \Illuminate\Http\Response
     */
    public function edit(Therapist $therapist)
    {
        return view('admin.therapist.edit', compact('therapist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Therapist  $therapist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Therapist $therapist)
    {
        $request->validate([
            'status' => 'required',
            'therapist_status' => 'required'
        ], [
            'status.required' => 'Status penerimaan therapist wajib untuk dipilih.',
            'therapist_status.required' => 'Status akun therapist wajib untuk dipilih.'
        ]);

        try {
            $prev_status = $therapist->status;

            $therapist->status = $request->status;
            $therapist->blocked = $request->therapist_status;
            $therapist->save();

            $this->sendApprovalEmail($prev_status, $therapist);

            return response()->json(['message'  => 'Data berhasil diupdate.'], 200);
        } catch (\Throwable $th) {
            // return response()->json(['message'  => $th->getMessage()], 500);
            return response()->json(['message'  => 'Data gagal diupdate!'], 500);
        }
    }

    /**
     * Mengirim email approval
     *
     * @param  string $previous_status
     * @param  App\Model\Therapist $therapist
     * @return void
     */
    protected function sendApprovalEmail($previous_status, Therapist $therapist)
    {
        if ($previous_status !== $therapist->status && $therapist->status !== "Menunggu") {
            Mail::to($therapist->email)->send(new TherapistRegisterNotification($therapist));
        }
    }

    /**
     * Update service therapist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Therapist  $therapist
     * @return \Illuminate\Http\Response
     */
    public function updateService(therapistRequest $request, Therapist $therapist)
    {
        try {
            $data = [];
            foreach ($request->service_id as $index => $service_id) {
                $data[$service_id] = [
                    'rate' => intval(str_replace(".", "", $request->rate[$index])),
                    'status' => $request->{'service.' . $service_id}
                ];
            }
            $therapist->services()->syncWithoutDetaching($data);
            return response()->json(['message'  => 'Data berhasil diupdate.'], 200);
        } catch (\Throwable $th) {
            // return response()->json(['message'  => $th->getMessage()], 500);
            return response()->json(['message'  => 'Data gagal diupdate!'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Therapist  $therapist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Therapist $therapist)
    {
        try {
            $therapist->services()->detach();
            $therapist->therapistAreas()->delete();
            $therapist->referrer->delete();
            $therapist->delete();
            return response()->json(['message'  => 'Data berhasil dihapus dari basis data.'], 200);
        } catch (\Throwable $th) {
            // return response()->json(['message'  => $th->getMessage()], 500);
            return response()->json(['message'  => 'Data gagal dihapus dari basis data.'], 500);
        }
    }
}
