<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Trail\UploadImage;

class Partnercontroller extends Controller
{
    use UploadImage;
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
        return view('partner.partnerCreate')
            ->with('map_index','map_index');
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
            'partner_name' => 'required',
           'image' => 'required|file|image|max:50000|mimes:jpeg,png,jpg'

        ]);

        $partner = new Partner();
        $partner->partner_name = $request->get('partner_name');
        $partner->icon = $this->upload($request,"partner_image");
        $partner->save();

        return back()->with('success','Add new partner successful');
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
        return view('partner.partnerCreate')
            ->with('map_index','map_index')
            ->with('edit',Partner::find($id));
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
            'partner_name' => 'required',
            'image' => 'file|image|max:50000|mimes:jpeg,png,jpg'
        ]);
        $partner = Partner::find($id);
        $partner->partner_name = $request->get('partner_name');

        if($request->hasFile("image")){
            Storage::delete("public/partner_image/".str_replace('/storage/partner_image/','',$partner->icon));
            $partner->icon = $this->upload($request,"partner_image");
        }
        $partner->save();
        return back()->with('success','Update partner successful');
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
