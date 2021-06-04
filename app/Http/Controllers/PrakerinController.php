<?php

namespace App\Http\Controllers;

use App\FileIndustry;
use App\FileStudent;
use App\Internship;
use App\Journal;
use App\User;
use App\Vacancy;
use App\VacancyApplicant;
use Illuminate\Http\Request;

class PrakerinController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if(auth()->user()->hasRole('siswa')){
                if(!auth()->user()->guidance_student){
                    flash('Anda belum mempunyai guru pembimbing')->error();
                    return redirect()->route('home');
                }

                $industry = 'no';
                $data = auth()->user()->vapplicant;
                if(isset($data)){
                    foreach($data as $value){
                        if($value->status == 'approved' && $value->vacancy->started_internship == 'yes'){
                            $industry = 'yes';
                        }
                    }
                }

                if(auth()->user()->guidance_student && $industry == 'no'){
                    flash('Anda belum diterima di industri. Silahkan lamar atau tambahkan sendiri tempat prakerin')->error();
                    return redirect()->route('prakerin.index_stemp');
                }

                if($industry == 'no'){
                    flash('Menu Prakerin tidak bisa dibuka, Anda belum diterima di industri / masa magang telah selesai')->error();
                    return redirect()->route('home');
                }
                return $next($request);
            }
            return $next($request);
        });
    }

    public function index_student()
    {
        $teacher = auth()->user()->guidance_student->guidance->teacher;
        $icustom = null;
        $industry = null;
        $data = auth()->user()->vapplicant;
        if(isset($data)){
            foreach($data as $value){
                if($value->status == 'approved' && $value->vacancy->started_internship == 'yes'){
                    $industry = VacancyApplicant::find($value->id);
                }
            }
        }

        $sfile = FileStudent::where([
                'student_id' => auth()->user()->id,
                'vacancy_id' => $industry->vacancy_id,
                ])->get();

        $ifile = FileIndustry::where([
                'student_id' => auth()->user()->id,
                'vacancy_id' => $industry->vacancy_id,
                ])->get();

        $journal = Journal::where([
            'student_id' => auth()->user()->id,
            'vacancy_id' => $industry->vacancy_id,
            ])->get();
        
        if(isset($industry) && !isset($industry->biography)){
            $icustom = Internship::latest()->get()[0];
        }

        return view('prakerin.index_s', compact('journal', 'teacher', 'industry', 'sfile', 'ifile', 'icustom'));
    }

    public function index_industry()
    {
        $candidates = VacancyApplicant::where([
                'biography_id' => auth()->user()->biography->id,
                'status' => 'approved',
                ])
                ->get()
                ->groupBy('vacancy_id');
        // dd($candidates);
        return view('prakerin.index_i', compact('candidates'));
    }

    public function show_student($id)
    {
        $data = User::find($id);
        $type = 'siswa';

        return view('prakerin.show', compact('data', 'type'));
    }
    
    public function show_teacher($id)
    {
        $data = User::find($id);
        $type = 'guru';

        return view('prakerin.show', compact('data', 'type'));
    }

    public function show_journal($id, $vacancy)
    {
        $user = User::find($id);
        $data = Journal::where([
                'student_id' => $id,
                'vacancy_id' => $vacancy,
            ])->get();

        return view('prakerin.journal', compact('user', 'data'));
    }

    public function show_file($id, $vacancy)
    {
        $user = User::find($id);
        $data = FileStudent::where([
                'student_id' => $id,
                'vacancy_id' => $vacancy,
            ])->get();

        return view('prakerin.file', compact('user', 'data'));
    }

    public function show_ifile($id)
    {
        $vacancy = Vacancy::find($id);
        $file_industry = FileIndustry::where([
                'biography_id' => auth()->user()->biography->id,
                'vacancy_id' => $id
            ])->get();

        return view('prakerin.ifile', compact('vacancy', 'file_industry'));
    }

    public function end($id)
    {
        try {
            $vacancy = Vacancy::find($id);
            $vacancy->update([
                'started_internship' => 'done',
            ]);
            
            return response()->json([
                'status' => true,
                'message' => 'Berhasil mengakhiri magang',
                'url' => route('prakerin.index_i'),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengakhiri magang',
            ]);
        }
    }
}
