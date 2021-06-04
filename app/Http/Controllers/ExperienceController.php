<?php

namespace App\Http\Controllers;

use App\Experience;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $months = [
            'Januari' => 'Januari',
            'Februari' => 'Februari',
            'Maret' => 'Maret',
            'April' => 'April',
            'Mei' => 'Mei',
            'Juni' => 'Juni',
            'Juli' => 'Juli',
            'Agustus' => 'Agustus',
            'September' => 'September',
            'Oktober' => 'Oktober',
            'November' => 'November',
            'Desember' => 'Desember',
        ];

        $years = range(Carbon::now()->year, 1962);

        return view('experience.create', compact('months', 'years'));
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
        $input['user_id'] = auth()->user()->id;
        $input['begin_at'] = $request->mstart.' '.$request->ystart;
        $input['end_at'] = $request->mend.' '.$request->yend;
        $now = $request->now;
        if($now == 'now'){
            $input['end_at'] = 'now';
        }
        
        Experience::create($input);

        flash('Berhasil menambahkan pengalaman')->success();

        return redirect()->route('profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Experience::find($id);
        $months = [
            'Januari' => 'Januari',
            'Februari' => 'Februari',
            'Maret' => 'Maret',
            'April' => 'April',
            'Mei' => 'Mei',
            'Juni' => 'Juni',
            'Juli' => 'Juli',
            'Agustus' => 'Agustus',
            'September' => 'September',
            'Oktober' => 'Oktober',
            'November' => 'November',
            'Desember' => 'Desember',
        ];

        $years = range(Carbon::now()->year, 1962);

        return view('experience.edit', compact('data', 'months', 'years'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $experience = Experience::find($id);
        $input = $request->all();

        $input['begin_at'] = $request->mstart.' '.$request->ystart;
        $input['end_at'] = $request->mend.' '.$request->yend;
        $now = $request->now;
        if($now == 'now'){
            $input['end_at'] = 'now';
        }

        $experience->update($input);

        flash('Berhasil mengedit pengalaman')->success();

        return redirect()->route('profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $experience = Experience::find($id);
            $experience->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus pengalaman',
                'url' => route('profile'),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus pengalaman'
            ]);
        }
    }
}
