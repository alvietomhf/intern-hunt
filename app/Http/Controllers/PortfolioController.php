<?php

namespace App\Http\Controllers;

use App\Portfolio;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
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
        $tags = Tag::all();
        return view('portfolio.create', compact('tags'));
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
        $input['tag_id'] = $request->tag;
        // dd($input);

        if ($request->hasFile('file')) {
            $input['file'] = rand().'.'.request()->file->getClientOriginalExtension();
            request()->file->move(public_path('uploads/files/'), $input['file']);
        }

        auth()->user()->portfolio()->create($input);

        flash('Berhasil menambahkan portofolio')->success();

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
        $data = Portfolio::find($id);
        $tags = Tag::all();

        return view('portfolio.edit', compact('data', 'tags'));
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
        $portfolio = Portfolio::find($id);
        $input = $request->all();
        $input['tag_id'] = $request->tag;

        $oldfile = $portfolio->file;
        if ($request->hasFile('file')) {
            if($oldfile != null) {
                File::delete('uploads/files/'.$oldfile);
            }
            $input['file'] = rand().'.'.request()->file->getClientOriginalExtension();
            request()->file->move(public_path('uploads/files'), $input['file']);
        } else {
            $input['file'] = $oldfile;
        }

        $portfolio->update($input);

        flash('Berhasil mengedit portofolio')->success();

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
            $portfolio = Portfolio::find($id);
            File::delete('uploads/files/'.$portfolio->file);
            $portfolio->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus portofolio',
                'url' => route('profile'),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus portofolio'
            ]);
        }
    }
}
