<?php

namespace App\Http\Controllers;

use App\Internship;
use App\Vacancy;
use App\VacancyApplicant;
use Illuminate\Http\Request;

class VacancyApplicantController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {   
            if(auth()->user()->hasRole('siswa') && !auth()->user()->biography) {
                flash('Harap isi biografi terlebih dahulu')->error();
                return redirect()->route('profile');
            }

            if(auth()->user()->hasRole('siswa') && !auth()->user()->portfolio()->exists()) {
                flash('Harap masukkan portofolio terlebih dahulu')->error();
                return redirect()->route('profile');
            }

            return $next($request);
        });
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_portfolio = auth()->user()->portfolio;
        $tags = [];
        $tag = [];
        
        foreach($user_portfolio as $value){
            $tags[] = $value->tag_id; 
        }
        foreach($tags as $value){
            if(!in_array($value, $tag)){
                $tag[] += $value;
            }
        }

        if(request()->detail == 'proposal'){
            $data = VacancyApplicant::where([
                ['user_id', auth()->user()->id],
                ['biography_id', '!=', 'null'],
            ])->get();
            $detail = 'proposal';
        } else {
            $data = Vacancy::where([
                ['active', '=', 'yes'],
                ['started_internship', '!=', 'done']
            ])
            ->whereIn('tag_id', $tag)
            ->get();
            $detail = 'lowongan';
        }

        return view('vacancy.applicant', compact('data', 'detail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id)
    {
        //
    }

    public function detail($id)
    {
        $data = VacancyApplicant::find($id);

        return view('vacancy.detail', compact('data'));
    }

    public function index_studentTemp()
    {
        $data = auth()->user()->vapplicant;
        $started = 'no';
        if(isset($data)){
            foreach($data as $value){
                if($value->status == 'approved' && $value->vacancy->started_internship == 'yes'){
                    $started = 'yes';
                }
            }
        }
        if($started == 'yes'){
            return redirect()->route('prakerin.index_s');
        }
        
        $experience = Internship::where('student_id', auth()->user()->id)->get();

        $teacher = auth()->user()->guidance_student->guidance->teacher;

        return view('prakerin.index_stemp', compact('experience', 'teacher'));
    }
}
