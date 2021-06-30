<?php

namespace App\Http\Controllers;

use App\Vacancy;
use App\VacancyApplicant;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function show_rating($applicant_id, $vacancy_id)
    {
        $applicant = VacancyApplicant::find($applicant_id);
        $vacancy = Vacancy::find($vacancy_id);
        if(isset($applicant->rating)){
            return redirect()->route('profile');
        }
        if($vacancy->started_internship != 'done'){
            return redirect()->route('profile');
        }

        return view('prakerin.rating', compact('applicant', 'vacancy'));
    }

    public function store_rating(Request $request ,$id)
    {
        $applicant = VacancyApplicant::find($id);
        $applicant->update([
            'rating' => $request->rating
        ]);

        flash('Berhasil menambahkan rating')->success();

        return redirect()->route('profile');
    }
}
