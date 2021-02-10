<?php

namespace App\Http\Controllers;

use App\Models\Dreamteller;
use App\Models\DreamtellerImage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DreamTellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dreamTeller.dreamTellerList')
            ->with('dream_teller_list',Dreamteller::orderBy('id','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dreamTeller.dreamTellerCreate')
            ->with('dream_teller_create','dream');;
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
            'title' => 'required',
            'contentShow' => 'required',
            'recommendDigits' =>'required',
            'images' => 'required',

        ]);
        $dreamTeller = new  Dreamteller();
        $dreamTeller->makeDreamTeller($request->recommendDigits,$request->title,$request->contentShow);

        if($file=$request->file('images')){

                $dreamTellerImage = new DreamtellerImage();
                $stringImageReformat = base64_encode('_'.time());
                $ext = $file->getClientOriginalName();
                $imageName = $stringImageReformat.".".$ext;
                $imageEncode = File::get($file);

                $dreamTellerImage->dream_id = $dreamTeller->id;
                $dreamTellerImage->image = "/storage/dream_teller_image/".$imageName;
                $dreamTellerImage->save();
                Storage::disk('local')->put('public/dream_teller_image/'.$imageName, $imageEncode);


        }
        return redirect()->route('dream-teller.index')->with('success','Upload success');
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
        $dreamTeller = Dreamteller::find($id);
          return view('dreamTeller.dreamTellerCreate',compact(['dreamTeller']))
              ->with('dream_teller_create','dream');


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
        $request->validate([
            'title' => 'required',
            'contentShow' => 'required',
            'recommendDigits' =>'required',

        ]);

        $dreamTeller = Dreamteller::find($id);
        $dreamTeller->makeDreamTeller($request->recommendDigits,$request->title,$request->contentShow);

        if($request->hasFile("images")){
            Storage::delete("public/dream_teller_image/".str_replace('/storage/dream_teller_image/','',$dreamTeller->dreamTellerImages->first()->image));
            $request->images->storeAs("public/dream_teller_image",str_replace('/storage/dream_teller_image/','',$dreamTeller->dreamTellerImages->first()->image));
        }


        return redirect()->route('dream-teller.index')->with('success','Updated successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dreamTeller = Dreamteller::find($id);

        $dreamTeller->delete();
        $dreamTeller->dreamTellerImages->first()->delete();
        Storage::delete("public/dream_teller_image/".str_replace('/storage/dream_teller_image/','',$dreamTeller->dreamTellerImages->first()->image));
        return back()->with('success','Delete successful');
    }
}
