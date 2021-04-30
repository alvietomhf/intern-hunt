<?php

namespace App\Http\Controllers;

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
            $tags[] = $value->tags; 
        }
        foreach($tags as $value){
            foreach($value as $val){
                if(!in_array($val->id, $tag))
                $tag[] += $val->id;
            }
        }

        $data = VacancyApplicant::where('user_id', auth()->user()->id)->get();
        $vacancy = Vacancy::with('tags')->where([
                                ['active', '=', 'yes'],
                                ['started_internship', '!=', 'done']
                            ])
                            ->whereHas('tags', function($q) use ($tag){
                                $q->whereIn('tag_vacancy.tag_id', $tag);
                            })
                            ->get();

        return view('vacancy.applicant', compact('data', 'vacancy'));
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
        
    }
}
