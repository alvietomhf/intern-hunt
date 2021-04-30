<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bg = 'bg-primary';
        $title = 'Selamat, '.auth()->user()->name;
        $message = 'Akun anda sedang dalam keadaan sangat bagus';
        $icon = 'feather icon-award';

        if(auth()->user()->hasRole('industri') && !auth()->user()->biography->description && !auth()->user()->biography->image && !auth()->user()->biography->name){
            $bg = 'bg-danger';
            $title = 'Harap lengkapi biografi terlebih dahulu';
            $message = 'Detail biografi anda belum lengkap, segera lengkapi di menu profile!';
            $icon = 'feather icon-alert-circle';
        }

        if(auth()->user()->hasRole('guru|siswa') && !auth()->user()->biography){
            $bg = 'bg-danger';
            $title = 'Harap isi biografi terlebih dahulu';
            $message = 'Detail biografi anda belum lengkap, segera lengkapi di menu profile!';
            $icon = 'feather icon-alert-circle';
        }

        return view('home', compact('bg', 'title', 'message', 'icon'));
    }
}
