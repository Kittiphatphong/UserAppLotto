<?php

namespace App\Http\Controllers;

use App\Models\GoogleMap;
use App\Models\Partner;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Trail\UploadImage;
class GoogleMapController extends Controller
{
  use UploadImage;
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



        $location = New GoogleMap();
        $location->name = $request->get('name');
        $location->image = $this->upload($request,"google_map_image");
        $location->lat = $request->get('lat');
        $location->lng= $request->get('lng');
        $location->partner_id = $request->get('partner_id');
        $location->pr_id = $request->get('pr_id');
        $location->save();

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
        $provinces = Province::all();
        return view('maps.mapCreate')
            ->with('map_index','map_index')
            ->with('provinces',$provinces)
            ->with('partners',Partner::all())
            ->with('edit',$googleMap);
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
        $request->validate([
            'name' => 'required',
            'image' => 'file|image|max:50000|mimes:jpeg,png,jpg',
            'partner_id' => 'required',
            'pr_id' => 'required',
            'lat' => 'required',
            'lng' => 'required'

        ]);

        $googleMap->name = $request->get('name');
        $googleMap->lat = $request->get('lat');
        $googleMap->lng= $request->get('lng');
        $googleMap->partner_id = $request->get('partner_id');
        $googleMap->pr_id = $request->get('pr_id');
        $googleMap->save();

        if($request->hasFile("image")){
            Storage::delete("public/google_map_image/".str_replace('/storage/google_map_image/','',$googleMap->image));
            $googleMap->image = $this->upload($request,"google_map_image");
        }
        $googleMap->save();
        return redirect()->route('google-map.index')->with('success','Update location successful');
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
