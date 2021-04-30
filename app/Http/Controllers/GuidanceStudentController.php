<?php

namespace App\Http\Controllers;

use App\FileIndustry;
use App\FileStudent;
use App\Guidance;
use App\GuidanceStudent;
use App\Journal;
use App\User;
use App\Vacancy;
use App\VacancyApplicant;
use Illuminate\Http\Request;

class GuidanceStudentController extends Controller
{
    public function index(Guidance $guidance)
    {

    }

    public function create(Guidance $guidance)
    {
        $data = $guidance;
        $students = User::role('siswa')->whereDoesntHave('guidance_student')->get();

        return view('guidance.gscreate', compact('data' ,'students'));
    }

    public function store(Request $request, Guidance $guidance)
    {
        foreach($request->students as $student){
            GuidanceStudent::create([
                'guidance_id' => $guidance->id,
                'student_id' => $student,
            ]);
        }

        flash('Berhasil menambahkan siswa')->success();

        return redirect()->route('guidance.show', [$guidance->slug]);
    }

    public function studentProfile(Guidance $guidance, $id)
    {
        $data = GuidanceStudent::find($id);

        return view('guidance.showstd', compact('data'));
    }

    public function industryProfile(Guidance $guidance, $id)
    {
        $gs = GuidanceStudent::find($id)->student->vapplicant;
        $data = null;

        foreach($gs as $value){
            if($value->status == 'approved' && $value->vacancy->started_internship == 'yes'){
                $data = VacancyApplicant::find($value->id);
            }
        }

        return view('guidance.showids', compact('data'));
    }

    public function studentJournal(Guidance $guidance, $id, $vacancy)
    {
        $user = User::find($id);
        $data = Journal::where([
                'student_id' => $id,
                'vacancy_id' => $vacancy
            ])->get();

        return view('guidance.showjrnl', compact('user', 'data'));
    }

    public function studentFile(Guidance $guidance, $id, $vacancy)
    {
        $user = User::find($id);
        $data = FileStudent::where([
                'student_id' => $id,
                'vacancy_id' => $vacancy
            ])->get();

        return view('guidance.showsfile', compact('user', 'data'));
    }

    public function industryFile(Guidance $guidance, $id, $vacancy)
    {
        $user = User::find(Vacancy::find($vacancy)->biography->user->id);
        $data = FileIndustry::where([
                'student_id' => $id,
                'vacancy_id' => $vacancy
            ])->get();

        return view('guidance.showifile', compact('user', 'data'));
    }

    public function destroy(Guidance $guidance, $id)
    {
        try {
            $gs = GuidanceStudent::find($id);
            $gs->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus siswa',
                'url' => route('guidance.show', [$guidance->slug]),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => route('guidance.show', [$guidance->slug]),
            ]);
        }
    }
}
