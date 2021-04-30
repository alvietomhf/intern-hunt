<?php

namespace App\Http\Controllers;

use App\Biography;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BiographyController extends Controller
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
        return view('biography.create');
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

        if(auth()->user()->hasRole('industri')){
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $key => $img) {
                    $name = rand().'.'.$img->getClientOriginalExtension();
                    $img->move(public_path('uploads/images'), $name);
                    $data[] = $name;
                }
            }
            $input['image'] = json_encode($data);
        }

        Biography::create($input);

        flash('Berhasil menambahkan biografi')->success();

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
        $data = Biography::find($id);

        return view('biography.edit', compact('data'));
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
        $biography = Biography::find($id);
        $input = $request->all();

        if(auth()->user()->hasRole('industri')){
            $oldimage = $biography->image;
            if($request->hasFile('image')) {
                if($oldimage != null) {
                    foreach (json_decode($oldimage) as $key => $img) {
                        File::delete('uploads/images/'.$img);
                    }
                }
                foreach ($request->file('image') as $key => $img) {
                    $name = rand().'.'.$img->getClientOriginalExtension();
                    $img->move(public_path('uploads/images'), $name);
                    $data[] = $name;
                }
                $input['image'] = json_encode($data);
            } else {
                unset($input['image']);
            }
        }

        $biography->update($input);

        flash('Berhasil mengedit biografi')->success();

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
        //
    }
}
