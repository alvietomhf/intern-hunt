<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
            flash('Harap lengkapi biografi terlebih dahulu')->error();
            return redirect()->route('profile');
        }

        if(auth()->user()->hasRole('guru|siswa') && !auth()->user()->biography){
            flash('Harap lengkapi biografi terlebih dahulu')->error();
            return redirect()->route('profile');
        }

        return view('home', compact('bg', 'title', 'message', 'icon'));
    }

    public function setting()
    {
        $data = auth()->user();
        return view('setting.index', compact('data'));
    }

    public function updateSetting(Request $request)
    {
        $user = auth()->user();
        $input = $request->all();

        $oldfile = $user->image;
        if ($request->hasFile('image')) {
            if($oldfile != null) {
                File::delete('uploads/images/'.$oldfile);
            }
            $input['image'] = rand().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('uploads/images'), $input['image']);
        } else {
            $input['image'] = $oldfile;
        }

        // dd($input);

        $user->update($input);

        flash('Berhasil menyimpan pengaturan')->success();

        return redirect()->route('home.setting');
    }

    public function updatePassword(Request $request)
    {
        if($request->password != $request->con_password) {
            flash('Konfirmasi password tidak sama')->error();
            return redirect()->route('home.setting');
        }

        $credentials = [
            'username' => auth()->user()->username,
            'password' => $request->old_password
        ];

        if(!\Auth::attempt($credentials)) {
            flash('Password lama anda salah')->error();
            return redirect()->route('home.setting');
        }

        $user = auth()->user();
        $user->password = \Hash::make($request->password);
        $user->save();
        
        flash('Berhasil merubah password')->success();
        return redirect()->route('home.setting');
    }
}
