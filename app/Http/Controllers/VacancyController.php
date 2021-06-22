<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Vacancy;
use App\VacancyApplicant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->type == 'all') {
            $data = Vacancy::where('biography_id', '!=', auth()->user()->biography->id)->get();
            $type = 'all';
            $detail = 'all';
        } else {
            if(request()->detail == 'lowongan'){
                if(!auth()->user()->biography->description && !auth()->user()->biography->image && !auth()->user()->biography->name){
                    flash('Harap lengkapi biografi terlebih dahulu')->error();
                    return redirect()->route('profile');
                }
                $data = Vacancy::where('biography_id', auth()->user()->biography->id)->get();
                $type = 'active';
                $detail = 'lowongan';
            } else {
                $data = VacancyApplicant::where('biography_id', auth()->user()->biography->id)->get();
                $type = 'active';
                $detail = 'proposal';
            }
        }

        return view('vacancy.index', compact('data', 'type', 'detail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();

        return view('vacancy.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $input['begin_at'] = Carbon::createFromFormat('m/d/Y', $request->begin_at, 'Asia/Jakarta');
        $input['end_at'] = Carbon::createFromFormat('m/d/Y', $request->end_at, 'Asia/Jakarta');
        $input['biography_id'] = auth()->user()->biography->id;
        $input['tag_id'] = $request->tag;

        foreach ($request->description as $key => $value) {
            $data[] = $value;
        }
        $input['description'] = json_encode($data);

        Vacancy::create($input);

        flash('Berhasil menambahkan lowongan')->success();

        return redirect()->route('vacancy.index', ['type' => 'active', 'detail' => 'lowongan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Vacancy::find($id);

        return view('vacancy.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Vacancy::find($id);
        $tags = Tag::all();

        return view('vacancy.edit', compact('data', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vacancy = Vacancy::find($id);
        $input = $request->all();

        $input['begin_at'] = Carbon::createFromFormat('m/d/Y', $request->begin_at, 'Asia/Jakarta');
        $input['end_at'] = Carbon::createFromFormat('m/d/Y', $request->end_at, 'Asia/Jakarta');
        $input['tag_id'] = $request->tag;

        foreach ($request->description as $key => $value) {
            $data[] = $value;
        }
        $input['description'] = json_encode($data);

        $vacancy->update($input);

        flash('Berhasil mengedit lowongan')->success();

        return redirect()->route('vacancy.index', ['type' => 'active', 'detail' => 'lowongan']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $vacancy = Vacancy::find($id);

            $vacancy->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus lowongan',
                'url' => route('vacancy.index', ['type' => 'active', 'detail' => 'lowongan']),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus lowongan',
            ]);
        }
    }

    public function getApply($id)
    {
        $data = Vacancy::find($id);
        return view('vacancy.apply', compact('data'));
    }
    
    public function apply($id, Request $request)
    {
        if(!auth()->user()->guidance_student){
            flash('Tidak bisa melamar, Anda belum mempunyai guru pembimbing')->error();
            return redirect()->route('applicant.index');
        }
        $input = $request->all();

        $vacancy = Vacancy::find($id);

        if(date('Y-m-d') > date('Y-m-d', strtotime($vacancy->end_at))) {
            flash('Mohon maaf, Lowongan sudah ditutup')->error();
            return redirect()->route('applicant.index');
        }
        if(date('Y-m-d') < date('Y-m-d', strtotime($vacancy->begin_at))) {
            flash('Mohon maaf, Lowongan belum dibuka')->error();
            return redirect()->route('applicant.index');
        }

        $data = VacancyApplicant::where('user_id', auth()->user()->id)->get();

        $isApplied = VacancyApplicant::where([
                                    'vacancy_id' => $vacancy->id,
                                    'user_id' => auth()->user()->id
                                ])->where(function($q) {
                                    $q->where('status', 'waiting')
                                        ->orWhere('status', 'approved')
                                        ->orWhere('status', 'rejected')
                                        ->orWhere('status', 'canceled');
                                })->first();
                                
        if($isApplied) {
            if($isApplied->status == 'approved') {
                flash('Anda sudah mendapatkan tempat prakerin.')->warning();
            } elseif($isApplied->status == 'rejected') {
                flash('Anda sudah ditolak oleh pihak industri.')->error();
            } elseif($isApplied->status == 'canceled') {
                flash('Lamaran telah dicancel.')->error();
            }
            else {
                flash('Anda sudah melamar di lowongan ini, harap tunggu konfirmasi dari industri.')->error();
            }
            return redirect()->route('applicant.index');
        }

        foreach($data as $value){
            if($value->status == 'approved' && $value->vacancy->started_internship == 'yes'){
                flash('Anda sudah mendapatkan tempat prakerin.')->warning();
                return redirect()->route('applicant.index');
            }
        }

        $input['biography_id'] = $vacancy->biography_id;
        $input['user_id'] = auth()->user()->id;
        $input['vacancy_id'] = $vacancy->id;

        if ($request->hasFile('file')) {
            $input['file'] = rand().'.'.request()->file->getClientOriginalExtension();
            request()->file->move(public_path('uploads/files/'), $input['file']);
        }
        
        VacancyApplicant::create($input);

        flash('Berhasil melamar lowongan')->success();

        return redirect()->route('applicant.index', ['detail' => 'proposal']);
    }

    public function action($id, $approval)
    {
        try {
            $vacancy_applicant = VacancyApplicant::find($id);
            $vacancy = $vacancy_applicant->vacancy;
            $data = VacancyApplicant::where('user_id', $vacancy_applicant->user_id)->get();

            $isAcc = false;
            foreach($data as $value){
                if($value->status == 'approved' && $value->vacancy->started_internship == 'yes'){
                    $isAcc = true;
                }
            }

            if($isAcc){
                return response()->json([
                    'status' => false,
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => 'Canceled, pelamar sudah diterima magang!',
                    'url' => route('vacancy.index', ['type' => 'active', 'detail' => 'lamaran'])
                ]);
            }

            $vacancy_applicant->update([
                'status' => $approval,
            ]);

            $dataNew = VacancyApplicant::where('user_id', $vacancy_applicant->user_id)->get();

            if($approval == 'approved'){
                $vacancy_applicant->update([
                    'acc' => Carbon::now(),
                ]);

                foreach($dataNew as $value){
                    if($value->status == 'waiting'){
                        $value->update([
                            'status' => 'canceled',
                        ]);
                    }
                }

                if($vacancy->started_internship == 'no'){
                    $vacancy->update([
                        'started_internship' => 'yes'
                    ]);
                }
            }

            return response()->json([
                'status' => true,
                'icon' => 'success',
                'title' => 'Berhasil',
                'message' => 'Berhasil '.$approval.' lamaran',
                'url' => route('vacancy.index', ['type' => 'active', 'detail' => 'lamaran'])
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal '.$approval.' lamaran',
            ]);
        }
    }

    public function status($id)
    {
        try {
            $vacancy = Vacancy::find($id);
            if($vacancy->active == 'yes'){
                $status = 'menonaktifkan';
                $vacancy->update([
                    'active' => 'no',
                ]);
            } else {
                $status = 'mengaktifkan';
                $vacancy->update([
                    'active' => 'yes',
                ]);
            }
            
            return response()->json([
                'status' => true,
                'message' => 'Berhasil '.$status.' lowongan',
                'url' => route('vacancy.index', ['type' => 'active', 'detail' => 'lowongan']),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal '.$status.' lowongan',
            ]);
        }
    }
}
