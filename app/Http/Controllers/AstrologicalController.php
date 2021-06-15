<?php

namespace App\Http\Controllers;

use App\Models\Astrological;
use Illuminate\Http\Request;

class AstrologicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('astrological.astrologicalList')
            ->with('astrological', Astrological::latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('astrological.astrologicalCreate')
            ->with('astrological','astrological');
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
           'name' => 'required|unique:astrologicals,name'
        ]);
        $astrological = new Astrological();
        $astrological->name = $request->name;
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
            'name' => 'required|unique:astrologicals,name'
        ]);

        $astrological->name = $request->name;
        $astrological->save();

        return redirect()->route('astrological.index')->with('Update successful');
    }

    public function destroy($id)
    {

        $astrological = Astrological::find($id);
        $astrological->delete();
        return redirect()->route('astrological.index')->with('Delete successful');
    }
}
