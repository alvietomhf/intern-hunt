<?php

namespace App\Http\Controllers;

use App\Biography;
use App\Experience;
use App\Portfolio;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $biography = Biography::where('user_id', auth()->user()->id)->first();
        $experience = Experience::where('user_id', auth()->user()->id)->get();
        $portfolio = Portfolio::where('user_id', auth()->user()->id)->get();

        return view('profiles.index', compact('biography', 'experience', 'portfolio'));
    }
}
