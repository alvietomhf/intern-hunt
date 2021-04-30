<?php

namespace App\Http\Controllers;

use App\Guidance;
use App\GuidanceStudent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuidanceController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {   
            if(auth()->user()->hasRole('guru') && !auth()->user()->biography) {
                flash('Harap isi biografi terlebih dahulu')->error();
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
        $data = Guidance::where('teacher_id', auth()->user()->id)->get();
        
        return view('guidance.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = User::role('siswa')->whereDoesntHave('guidance_student')->get();

        return view('guidance.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['slug'] = Str::random(10);
        $input['teacher_id'] = auth()->user()->id;

        $guidance = Guidance::create($input);
        foreach($request->students as $student){
            GuidanceStudent::create([
                'guidance_id' => $guidance->id,
                'student_id' => $student,
            ]);
        }

        flash('Berhasil menambahkan grup')->success();

        return redirect()->route('guidance.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Guidance $guidance)
    {
        $students = GuidanceStudent::where('guidance_id', $guidance->id)->get();

        return view('guidance.show', compact('guidance', 'students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Guidance $guidance)
    {
        $data = $guidance;

        return view('guidance.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guidance $guidance)
    {
        $input = $request->all();
        $guidance->update($input);

        flash('Berhasil mengedit grup')->success();

        return redirect()->route('guidance.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guidance $guidance)
    {
        try {
            $guidance->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus grup',
                'url' => route('guidance.index'),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus grup'
            ]);
        }
    }
}
