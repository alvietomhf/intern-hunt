<?php

namespace App\Http\Controllers;

use App\FileStudent;
use App\VacancyApplicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = auth()->user()->vapplicant;
        $bio_id = null;
        $vacancy_id = null;
        if(isset($data)){
            foreach($data as $value){
                if($value->status == 'approved' && $value->vacancy->started_internship == 'yes'){
                    $bio_id = VacancyApplicant::find($value->id)->biography->id;
                    $vacancy_id = VacancyApplicant::find($value->id)->vacancy_id;
                }
            }
        }

        return view('sfile.create', compact('bio_id', 'vacancy_id'));
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
        $input['student_id'] = auth()->user()->id;

        if ($request->hasFile('file')) {
            $input['file'] = rand().'.'.request()->file->getClientOriginalExtension();
            request()->file->move(public_path('uploads/files/'), $input['file']);
        }

        FileStudent::create($input);

        flash('Berhasil menambahkan file')->success();

        return redirect()->route('prakerin.index_s');
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
    public function edit($id)
    {
        $data = FileStudent::find($id);

        return view('sfile.edit', compact('data'));
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
        $filestudent = FileStudent::find($id);
        $input = $request->all();

        $oldfile = $filestudent->file;
        if ($request->hasFile('file')) {
            if($oldfile != null) {
                File::delete('uploads/files/'.$oldfile);
            }
            $input['file'] = rand().'.'.request()->file->getClientOriginalExtension();
            request()->file->move(public_path('uploads/files'), $input['file']);
        } else {
            $input['file'] = $oldfile;
        }

        $filestudent->update($input);

        flash('Berhasil mengubah file')->success();

        return redirect()->route('prakerin.index_s');
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
            $filestudent = FileStudent::find($id);
            File::delete('uploads/files/'.$filestudent->file);
            $filestudent->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus file',
                'url' => route('prakerin.index_s'),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus file'
            ]);
        }
    }
}
