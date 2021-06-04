<?php

namespace App\Http\Controllers;

use App\Internship;
use App\Vacancy;
use App\VacancyApplicant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InternshipController extends Controller
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
        return view('internship.create');
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

        $data_vacancy = [
            'title' => 'Ditambakan oleh Siswa',
            'description' => 'Default',
            'begin_at' => Carbon::now(),
            'end_at' => Carbon::now(),
            'active' => 'no',
            'started_internship' => 'yes'
        ];
        $vacancy = Vacancy::create($data_vacancy);
        $vacancy->tags()->attach([0 => '5']);

        $data_vapplicant = [
            'user_id' => auth()->user()->id,
            'vacancy_id' => $vacancy->id,
            'note' => 'Default',
            'status' => 'Approved',
            'file' => 'none.pdf', 
        ];
        $vapplicant = VacancyApplicant::create($data_vapplicant);

        Internship::create($input);

        flash('Berhasil menambahkan perusahaan')->success();

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
        $data = Internship::find($id);

        return view('internship.edit', compact('data'));
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
        $internship = Internship::find($id);
        $input = $request->all();

        $internship->update($input);

        flash('Berhasil mengubah perusahaan')->success();

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
            $internship = Internship::find($id);
            $internship->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus perusahaan',
                'url' => route('prakerin.index_s'),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus perusahaan',
            ]);
        }
    }
}
