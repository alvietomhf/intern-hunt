<?php

namespace App\Http\Controllers;

use App\Guidance;
use App\GuidanceStudent;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // $students = User::role('siswa')->whereDoesntHave('guidance_student')->get();

        return view('guidance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
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

            DB::commit();
            flash('Berhasil menambahkan grup')->success();

            return redirect()->route('guidance.index');
        } catch (Exception $e) {
            DB::rollback();
            flash('Pilih siswa terlebih dahulu')->error();

            return redirect()->route('guidance.create');
        }
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
        // dd($students);
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

    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = User::role('siswa')->whereDoesntHave('guidance_student')
         ->where('name', 'like', '%'.$query.'%')
         ->orWhere('department', 'like', '%'.$query.'%')
         ->whereDoesntHave('guidance_student')
         ->orderBy('id', 'desc')
         ->get();
      }
      else
      {
       $data = User::role('siswa')->whereDoesntHave('guidance_student')
         ->orderBy('id', 'desc')
         ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $key => $value)
       {
        $output .= '
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card card-bordered">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media">
                            <input type="checkbox" name="students[]" data-id="'.$value->id.'" id="student-'.$key.'" value="'.$value->id.'" class="mt-2 mr-1">
                            <img src="'.asset('uploads/images/'.$value->image).'" class="rounded-circle mr-2" alt="img-placeholder" height="50" width="50">
                            <div class="media-body">
                                <h5>'.$value->name.'</h5>
                                <p style="font-size: 10px">'.$value->department.'</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
       }
      }
      else
      {
       $output = '
       <div class="col-12"><h3>Tidak ditemukan</h3></div>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }
}
