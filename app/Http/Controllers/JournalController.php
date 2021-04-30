<?php

namespace App\Http\Controllers;

use App\Journal;
use App\VacancyApplicant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JournalController extends Controller
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
        $vacancy_id = null;
        if(isset($data)){
            foreach($data as $value){
                if($value->status == 'approved' && $value->vacancy->started_internship == 'yes'){
                    $vacancy_id = VacancyApplicant::find($value->id)->vacancy_id;
                }
            }
        }

        return view('journal.create', compact('vacancy_id'));
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
        $input['date'] = Carbon::createFromFormat('m/d/Y', $request->date, 'Asia/Jakarta');
        
        Journal::create($input);

        flash('Berhasil menambahkan jurnal')->success();

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
        $data = Journal::find($id);

        return view('journal.edit', compact('data'));
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
        $journal = Journal::find($id);
        $input = $request->all();
        $input['date'] = Carbon::createFromFormat('m/d/Y', $request->date, 'Asia/Jakarta');
        
        $journal->update($input);

        flash('Berhasil megubah jurnal')->success();

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
            $journal = Journal::find($id);
            $journal->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus jurnal',
                'url' => route('prakerin.index_s'),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus jurnal',
            ]);
        }
    }
}
