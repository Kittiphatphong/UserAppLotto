<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Zodiac;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ZodiacController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('zodiac.zodiacList')
            ->with('zodiac',Zodiac::latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('zodiac.zodiacCreate')
            ->with('zodiac','zodiac');
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
            'start' => 'required',
            'end' => 'required',
            'image' => 'required|file|image|max:50000|mimes:jpeg,png,jpg'
        ]);
        $stringImageReformat = base64_encode('_'.time());
        $ext = $request->file('image')->getClientOriginalExtension();
        $imageName = $stringImageReformat.".".$ext;
        $imageEncode = File::get($request->image);

        $zodiac = new Zodiac();
        $start = Carbon::parse($request->get('start'))->toDateTimeString();
        $end = Carbon::parse($request->get('end'))->toDateTimeString();

        $zodiac->name = $request->name;
        $zodiac->start = $start;
        $zodiac->end =$end;
        $zodiac->image = "/storage/zodiac_image/".$imageName;



        Storage::disk('local')->put('public/zodiac_image/'.$imageName, $imageEncode);

        return redirect()->route('zodiac.index')->with('success','Create zodiac success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zodiac  $zodiac
     * @return \Illuminate\Http\Response
     */
    public function show(Zodiac $zodiac)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zodiac  $zodiac
     * @return \Illuminate\Http\Response
     */
    public function edit(Zodiac $zodiac)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zodiac  $zodiac
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zodiac $zodiac)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zodiac  $zodiac
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zodiac $zodiac)
    {
        //
    }
}
