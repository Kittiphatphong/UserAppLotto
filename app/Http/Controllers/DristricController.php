<?php

namespace App\Http\Controllers;

use App\Models\Dristric;
use App\Models\Province;
use Illuminate\Http\Request;

class DristricController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     return view('address.districtIndex')
         ->with('district_index',Dristric::all())
         ->with('provinces',Province::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return view('address.districtCreate')
            ->with('district_index','district_index')
            ->with('edit','edit')
            ->with('district',Dristric::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $dristric = Dristric::find($id);
        $request->validate([
            'dr_name' => 'required',
            'dr_name' => 'required'
        ]);
        $dristric->dr_name = $request->dr_name;
        $dristric->dr_name_en = $request->dr_name_en;
        $dristric->save();
        return redirect()->route('district.index')->with('success','Updated district successful');
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
