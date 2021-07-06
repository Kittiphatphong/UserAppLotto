<?php

namespace App\Http\Controllers;

use App\Models\Fortune;
use App\Models\Temple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FortuneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view ('fortune.fortuneIndex')
            ->with('fortune_index',Temple::find($request->temple_id));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('fortune.fortuneCreate')
            ->with('fortune_index',Temple::find($request->temple_id));
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
            "no" => "required | numeric",
            "content" => 'required',
            "image" => "required|file|image|max:50000|mimes:jpeg,png,jpg",
            "temple_id" => "required"
        ]);
        $stringImageReformat = base64_encode('_'.time());
        $ext = $request->file('image')->getClientOriginalExtension();
        $imageName = $stringImageReformat.".".$ext;
        $imageEncode = File::get($request->image);

        $fortune = New Fortune();
        $fortune->no = $request->get('no');
        $fortune->content = $request->get('content');
        $fortune->temple_id = $request->get('temple_id');
        $fortune->image = "/storage/fortune_image/".$imageName;
        $fortune->save();

        Storage::disk('local')->put('public/fortune_image/'.$imageName, $imageEncode);
        return redirect()->route('temple.index')->with('success','Add new fortune successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fortune  $fortune
     * @return \Illuminate\Http\Response
     */
    public function show(Fortune $fortune)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fortune  $fortune
     * @return \Illuminate\Http\Response
     */
    public function edit(Fortune $fortune)
    {
        return view('fortune.fortuneCreate')
            ->with('fortune_index',Temple::find($fortune->temples->id))
            ->with('edit',$fortune);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fortune  $fortune
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fortune $fortune)
    {
        $request->validate([
            "no" => "required | numeric",
            "content" => 'required',
            "image" => "file|image|max:50000|mimes:jpeg,png,jpg",
        ]);

        $fortune->no = $request->get('no');
        $fortune->content = $request->get('content');
        $fortune->save();

        if($request->hasFile("image")){
            Storage::delete("public/fortune_image/".str_replace('/storage/fortune_image/','',$fortune->image));
            $request->image->storeAs("public/fortune_image",str_replace('/storage/fortune_image/','',$fortune->image));
        }

        return redirect()->route('temple.index')->with('success','Update fortune successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fortune  $fortune
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fortune = Fortune::find($id);
        Storage::delete("public/fortune_image/".str_replace('/storage/fortune_image/','',$fortune->image));
        $fortune->delete();
        return back()->with('success','Delete successful');
    }

    public function changeStatus($id){
        $temple = Temple::find($id);
        if($temple->status == true){
            $temple->status = false;
        }else{
            $temple->status = true;
        }
        $temple->save();
        return back()->with('success','Update status successful');

    }
}
