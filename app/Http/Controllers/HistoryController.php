<?php

namespace App\Http\Controllers;

use App\FileIndustry;
use App\FileStudent;
use App\Journal;
use App\Vacancy;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function prakerin_history($id, $vacancy_id)
    {
        $vacancy = Vacancy::find($vacancy_id);
        $journal = Journal::where([
            'student_id' => auth()->user()->id,
            'vacancy_id' => $vacancy->id,
        ])->get();
        $student_file = FileStudent::where([
            'student_id' => auth()->user()->id,
            'vacancy_id' => $vacancy->id,
        ])->get();
        $industry_file = FileIndustry::where([
            'vacancy_id' => $vacancy->id,
            'student_id' => auth()->user()->id,
        ])->get();

        return view('prakerin.history', compact('vacancy', 'journal', 'student_file', 'industry_file'));
    }
}
