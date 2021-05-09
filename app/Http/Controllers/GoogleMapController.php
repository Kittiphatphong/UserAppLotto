<?php

namespace App\Http\Controllers;

use App\Models\GoogleMap;
use App\Models\Partner;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GoogleMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     return view('maps.mapIndex')
         ->with('partners',Partner::all())
         ->with('map_index',GoogleMap::with('partners')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::all();
        return view('maps.mapCreate')
            ->with('map_index','map_index')
            ->with('provinces',$provinces)
            ->with('partners',Partner::all());
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
            'name' => 'required',
            'image' => 'required|file|image|max:50000|mimes:jpeg,png,jpg',
            'partner_id' => 'required',
            'pr_id' => 'required',
            'lat' => 'required',
            'lng' => 'required'

        ]);

        $stringImageReformat = base64_encode('_'.time());
        $ext = $request->file('image')->getClientOriginalExtension();
        $imageName = $stringImageReformat.".".$ext;
        $imageEncode = File::get($request->image);

        $location = New GoogleMap();
        $location->name = $request->get('name');
        $location->image = "/storage/google_map_image/".$imageName;
        $location->lat = $request->get('lat');
        $location->lng= $request->get('lng');
        $location->partner_id = $request->get('partner_id');
        $location->pr_id = $request->get('pr_id');
        $location->save();

        Storage::disk('local')->put('public/google_map_image/'.$imageName, $imageEncode);
        return back()->with('success','Add new location successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GoogleMap  $googleMap
     * @return \Illuminate\Http\Response
     */
    public function show(GoogleMap $googleMap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GoogleMap  $googleMap
     * @return \Illuminate\Http\Response
     */
    public function edit(GoogleMap $googleMap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GoogleMap  $googleMap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoogleMap $googleMap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GoogleMap  $googleMap
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoogleMap $googleMap)
    {
        //
    }
}
