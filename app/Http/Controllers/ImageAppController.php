<?php

namespace App\Http\Controllers;

use App\Models\ImageApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     return view('imageApp.imageAppIndex')
         ->with('image_app_index',ImageApp::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('imageApp.imageAppCreate')
            ->with('image_app_index','image_app_index');
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
            'image' => 'required|file|image|max:50000|mimes:jpeg,png,jpg',
        ]);
        $imageApp = new ImageApp();
        $stringImageReformat = base64_encode('_'.time());
        $ext = $request->file('image')->getClientOriginalExtension();
        $imageName = $stringImageReformat.".".$ext;
        $imageEncode = File::get($request->image);
        $imageApp->image = "/storage/background_app_image/".$imageName;
//        $imageApp->active = true;
        $imageApp->save();
        Storage::disk('local')->put('public/background_app_image/'.$imageName, $imageEncode);
        return redirect()->route('image-app.index')->with('success','success');
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
        return view('imageApp.imageAppCreate')
            ->with('image_app_index','image_app_index')
            ->with('edit','edit')
            ->with('imageApp',ImageApp::find($id));
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
            'image' => 'file|image|max:50000|mimes:jpeg,png,jpg',
        ]);
        $imageApp = ImageApp::find($id);
        if($request->hasFile("image")){
            Storage::delete("public/background_app_image/".str_replace('/storage/background_app_image/','',$imageApp->image));
            $request->image->storeAs("public/background_app_image",str_replace('/storage/background_app_image/','',$imageApp->image));
        }
        return redirect()->route('image-app.index')->with('success','Update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imageApp = ImageApp::find($id);
        $imageApp->delete();
        Storage::delete("public/background_app_image/".str_replace('/storage/background_app_image/','',$imageApp->image));
        return redirect()->route('image-app.index')->with('success','Delete success');
    }

    public function active(Request $request){
        DB::table('image_apps')->where('status',true)->update(['status_win' => 0]);
        dd($request->active);
    }
}
