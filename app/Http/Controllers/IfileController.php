<?php

namespace App\Http\Controllers;

use App\FileIndustry;
use App\Vacancy;
use App\VacancyApplicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class IfileController extends Controller
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
    public function create($vacancy_id)
    {
        $data = VacancyApplicant::where([
                'biography_id' => auth()->user()->biography->id,
                'status' => 'approved',
                'vacancy_id' => $vacancy_id,
        ])->get();

        return view('ifile.create', compact('data', 'vacancy_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($vacancy_id, Request $request)
    {
        $input = $request->all();
        $input['biography_id'] = auth()->user()->biography->id;
        $input['vacancy_id'] = $vacancy_id;

        if ($request->hasFile('file')) {
            $file = rand().'.'.request()->file->getClientOriginalExtension();
            request()->file->move(public_path('uploads/files/'), $file);
        }

        foreach($request->students as $student){
            $img_name = rand().'.'.request()->file->getClientOriginalExtension();
            copy(public_path('uploads/files/'.$file), public_path('uploads/files/'.$img_name));

            $input['student_id'] = $student;
            $input['file'] = $img_name;

            FileIndustry::create($input);
        }

        File::delete('uploads/files/'.$file);
        
        flash('Berhasil menambahkan file')->success();

        return redirect()->route('prakerin.index_i');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($vacancy_id, $id)
    {
        try {
            $fileindustry = FileIndustry::find($id);
            File::delete('uploads/files/'.$fileindustry->file);
            $fileindustry->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus file',
                'url' => route('prakerin.show_ifile', [$vacancy_id]),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus file'
            ]);
        }
    }
}
