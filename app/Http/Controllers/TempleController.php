<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Temple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Trail\UploadImage;
class TempleController extends Controller
{
    use UploadImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fortune.templeIndex')
            ->with('fortune_index',Temple::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fortune.templeCreate')
            ->with('fortune_index','fortune_index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'temple_name' => 'required',
           'image' => 'required|file|image|max:50000|mimes:jpeg,png,jpg'
        ]);

        $temple = new Temple();
        $temple->temple_name = $request->get('temple_name');
        $temple->image = $this->upload($request,"temple_image");
        $temple->save();

        return redirect()->route('temple.index')->with('success','Add new temple successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Temple  $temple
     * @return \Illuminate\Http\Response
     */
    public function show(Temple $temple)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Temple  $temple
     * @return \Illuminate\Http\Response
     */
    public function edit(Temple $temple)
    {
        return view('fortune.templeCreate')
            ->with('fortune_index','fortune_index')
            ->with('edit',$temple);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Temple  $temple
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Temple $temple)
    {
        $request->validate([
            'temple_name' => 'required',
            'image' => 'file|image|max:50000|mimes:jpeg,png,jpg'
        ]);



        if($request->hasFile("image")){
            Storage::delete("public/temple_image/".str_replace('/storage/temple_image/','',$temple->image));


            $temple->temple_name = $request->get('temple_name');
            $temple->image = $this->upload($request,"temple_image");


        }else{
            $temple->temple_name = $request->get('temple_name');

        }
        $temple->save();
        return redirect()->route('temple.index')->with('success','update temple successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Temple  $temple
     * @return \Illuminate\Http\Response
     */
    public function destroy(Temple $temple)
    {
        //
    }
}
