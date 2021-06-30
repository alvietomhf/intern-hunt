<?php

namespace App\Http\Controllers;

use App\Biography;
use App\Internship;
use App\Vacancy;
use App\VacancyApplicant;
use Illuminate\Database\Eloquent\Collection;
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
            $vacancy = Vacancy::where([
                ['active', '=', 'yes'],
                ['started_internship', '!=', 'done']
            ])
            ->whereIn('tag_id', $tag)
            ->get();

            $collection = new Collection();

            foreach($vacancy as $item){
                $applicant = VacancyApplicant::where([
                    ['biography_id', $item->biography_id],
                    ['status', 'approved'],
                ])
                ->whereNotNull('rating');
                
                $total_rating = 0;
                $profile_item = 0;

                foreach ($applicant->get() as $value) {
                    if(isset($value->rating)){
                        $total_rating += $value->rating;
                    }
                }

                if(isset($item->biography->address)) $profile_item++;
                if(isset($item->biography->phone)) $profile_item++;
                if(isset($item->biography->email)) $profile_item++;

                $rating = 0;
                if($applicant->count() > 0){
                    $rating = $total_rating/$applicant->count();
                }
                $description = count(json_decode($item->description));
                $image = 0;
                if(!empty(json_decode($item->biography->image))){
                    $image = count(json_decode($item->biography->image));
                }
                $profile = $profile_item;

                //Description
                $total_c1 = 0;
                if($description >= 5) $total_c1 = 1;
                elseif($description >=3) $total_c1 = 0.75;
                elseif($description >=1) $total_c1 = 0.25;
                else $total_c1 = 0;

                //Profile
                $total_c2 = 0;
                if($profile == 3) $total_c2 = 1;
                elseif($profile == 2) $total_c2 = 0.75;
                elseif($profile == 1) $total_c2 = 0.25;
                else $total_c2 = 0;

                //Image
                $total_c3 = 0;
                if($image >= 5) $total_c3 = 1;
                elseif($image >= 3) $total_c3 = 0.75;
                elseif($image >= 1) $total_c3 = 0.25;
                else $total_c3 = 0;

                //Rating
                $total_c4 = 0;
                if($rating >= 4) $total_c4 = 1;
                elseif($rating >= 2) $total_c4 = 0.75;
                elseif($rating >= 1) $total_c4 = 0.25;
                else $total_c4 = 0;

                $c1 = $this->c1($total_c1);
                $c2 = $this->c2($total_c2);
                $c3 = $this->c3($total_c3);
                $c4 = $this->c4($total_c4);

                $ranking = $c1+$c2+$c3+$c4;

                $collection->push((object)[
                    'id' => $item->id,
                    'tag_id' => $item->tag_id,
                    'title' => $item->title,
                    'image' => $item->biography->user->image,
                    'name' => $item->biography->name ? $item->biography->name : $item->biograpghy->user->name,
                    'ranking' => $ranking,
                    'begin_at' => $item->begin_at,
                    'end_at' => $item->end_at,
                ]);
            };
            
            $data = $collection->sortByDesc('ranking');

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

        $applicant = null;
        $not_acc = 'no';

        if(isset($data)){
            foreach($data as $value){
                if($value->status == 'waiting' && !isset($value->acc) && !isset($value->vacancy->biography) && $value->vacancy->started_internship == 'yes'){
                    $not_acc = 'yes';
                    $applicant = VacancyApplicant::find($value->id);
                }
            }
        }

        if(isset($data)){
            foreach($data as $value){
                if($value->status == 'approved' && $value->vacancy->started_internship == 'yes'){
                    $started = 'yes';
                }
            }
        }
        
        $collection = new Collection();
        $applicant_approved = VacancyApplicant::where([
            ['user_id', auth()->user()->id],
            ['status', 'approved']
        ])->get();

        foreach ($applicant_approved as $item) {
            if(!isset($item->biography) && $item->vacancy->started_internship == 'done'){
                list($name, $address) = explode('|', $item->note);
                $collection->push((object)[
                    'id' => $item->id,
                    'vacancy_id' => $item->vacancy_id,
                    'name' => $name,
                    'address' => $address,
                    'start' => $item->acc,
                    'end' => $item->vacancy->ended_internship,
                    'status' => 'Selesai',
                ]);
            }
            if(isset($item->biography) && $item->vacancy->started_internship == 'done'){
                $collection->push((object)[
                    'id' => $item->id,
                    'vacancy_id' => $item->vacancy_id,
                    'name' => $item->biography->name ? $item->biography->name : $item->biography->user->name,
                    'address' => $item->biography->address,
                    'start' => $item->acc,
                    'end' => $item->vacancy->ended_internship,
                    'status' => 'Selesai',
                ]);
            }
        }

        if($started == 'yes'){
            return redirect()->route('prakerin.index_s');
        }
        
        $experience = $collection;

        $teacher = auth()->user()->guidance_student->guidance->teacher;
        
        return view('prakerin.index_stemp', compact('experience', 'teacher', 'applicant', 'not_acc'));
    }

    public function c1($num){
        return $num * 0.40;
    }
    
    public function c2($num){
        return $num * 0.25;
    }

    public function c3($num){
        return $num * 0.15;
    }

    public function c4($num){
        return $num * 0.20;
    }
}
