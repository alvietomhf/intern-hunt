<?php

namespace App\Http\Controllers;

use App\VacancyApplicant;
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

        $applicant = null;
        $data = auth()->user()->vapplicant;
        if(isset($data)){
            foreach($data as $value){
                if($value->status == 'approved' && $value->vacancy->started_internship == 'done' && !isset($value->rating)){
                    $applicant = VacancyApplicant::find($value->id);
                }
            }
        }

        $applicant2 = null;
        $not_acc = 'no';
        if(isset($data)){
            foreach($data as $value){
                if($value->status == 'waiting' && !isset($value->acc) && !isset($value->vacancy->biography) && $value->vacancy->started_internship == 'yes'){
                    $not_acc = 'yes';
                    $applicant2 = VacancyApplicant::find($value->id);
                }
            }
        }

        if(auth()->user()->hasRole('siswa') && isset($applicant) && !isset($applicant->rating) && isset($applicant->biography)){
            return redirect()->route('prakerin.show_rating', [$applicant->id, $applicant->vacancy->id]);
        }

        if(auth()->user()->hasRole('guru|siswa') && !auth()->user()->biography){
            flash('Harap lengkapi biografi terlebih dahulu')->error();
            return redirect()->route('profile');
        }

        return view('home', compact('bg', 'title', 'message', 'icon', 'not_acc', 'applicant2'));
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

        if($user->hasRole('industri')){
            $user->update(['name' => $request->name, 'image' => $input['image']]);
            $user->biography->update([
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);
        } else {
            $user->update($input);
        }

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

    public function banner()
    {
        return view('setting.banner');
    }

    public function updateBanner(Request $request)
    {
        $user = auth()->user();
        $input = $request->all();

        $oldfile = $user->banner;
        if ($request->hasFile('banner')) {
            if($oldfile != null) {
                File::delete('uploads/images/'.$oldfile);
            }
            $input['banner'] = rand().'.'.request()->banner->getClientOriginalExtension();
            request()->banner->move(public_path('uploads/images'), $input['banner']);
        } else {
            $input['banner'] = $oldfile;
        }

        $user->update($input);

        flash('Berhasil merubah banner')->success();

        return redirect()->route('profile');
    }
}
