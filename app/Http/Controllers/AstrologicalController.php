<?php

namespace App\Http\Controllers;

use App\Models\Astrological;
use Illuminate\Http\Request;
use App\Http\Resources\AstrologicalResource;
use App\Http\Controllers\Trail\UploadImage;
class AstrologicalController extends Controller
{
   use UploadImage;
    public function index()
    {
        return view('astrological.astrologicalList')
            ->with('astrological', Astrological::latest()->get());

    }

    public function create()
    {
        return view('astrological.astrologicalCreate')
            ->with('astrological','astrological');
    }


    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required|unique:astrologicals,name',
            'image' => 'required|file|image|max:50000|mimes:jpeg,png,jpg',
        ]);
        $astrological = new Astrological();
        $astrological->name = $request->name;
        $astrological->image = $this->upload($request,'astrological_image');
        $astrological->save();

        return redirect()->route('astrological.index')->with('Create successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Astrological  $astrological
     * @return \Illuminate\Http\Response
     */
    public function show(Astrological $astrological)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Astrological  $astrological
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('astrological.astrologicalCreate')
            ->with('astrological','astrological')
            ->with('edit',Astrological::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Astrological  $astrological
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Astrological $astrological)
    {
        $request->validate([
            'name' => 'required|unique:astrologicals,name',
            'image' => 'file|image|max:50000|mimes:jpeg,png,jpg',
        ]);

        $astrological->name = $request->name;

        if($request->file('image')){
            $astrological->image = $this->editImage($request,$astrological,'astrological_image');
        }

        $astrological->save();

        return redirect()->route('astrological.index')->with('Update successful');
    }

    public function destroy($id)
    {

        $astrological = Astrological::find($id);
        $this->delete($astrological,'astrological_image');
        $astrological->delete();
        return redirect()->route('astrological.index')->with('Delete successful');
    }
}
