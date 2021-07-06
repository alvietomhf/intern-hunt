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

    public function imageCreate()
    {
        return view('biography.image');
    }

    public function imageUpload(Request $request)
    {
        $biography = Biography::find(auth()->user()->biography->id);
        $input = $request->all();
        $oldimage = $biography->image;
        $data = [];

        if ($request->hasFile('image')) {
            if($oldimage != null) {
                $imgDecode = json_decode($oldimage);
                foreach ($request->file('image') as $key => $img) {
                    $name = rand().'.'.$img->getClientOriginalExtension();
                    $img->move(public_path('uploads/images'), $name);
                    array_push($imgDecode, ['id' => rand(), 'name' => $name]);
                }
                $data = $imgDecode;
            } else {
                foreach ($request->file('image') as $key => $img) {
                    $name = rand().'.'.$img->getClientOriginalExtension();
                    $img->move(public_path('uploads/images'), $name);
                    array_push($data, ['id' => rand(), 'name' => $name]);
                }
            }
        }
        $input['image'] = json_encode($data);

        $biography->update($input);

        flash('Berhasil menambahkan foto')->success();

        return redirect()->route('profile');
    }

    public function imageDelete($id)
    {
        try {
            $biography = Biography::find(auth()->user()->biography->id);

            $image = json_decode($biography->image);
            foreach ($image as $key => $img) {
                if($img->id == $id){
                    File::delete('uploads/images/'.$img->name);
                }
            }

            $image = array_filter($image, function ($item) use ($id) {
                return $item->id != $id;
            });
            $data = array_values($image);

            $biography->update([
                'image' => json_encode($data)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus foto',
                'url' => route('profile'),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus foto'
            ]);
        }

        
    }
}
