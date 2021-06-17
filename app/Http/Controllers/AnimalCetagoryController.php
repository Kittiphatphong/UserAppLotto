<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\AnimalCetagory;
use Illuminate\Http\Request;

class AnimalCetagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('animalCategory.animalCategoryList')
            ->with('animal_category',AnimalCetagory::latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('animalCategory.animalCategoryCreate')
            ->with('animals',Animal::all());
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
       'name' => 'required'
    ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnimalCetagory  $animalCetagory
     * @return \Illuminate\Http\Response
     */
    public function show(AnimalCetagory $animalCetagory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnimalCetagory  $animalCetagory
     * @return \Illuminate\Http\Response
     */
    public function edit(AnimalCetagory $animalCetagory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnimalCetagory  $animalCetagory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnimalCetagory $animalCetagory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnimalCetagory  $animalCetagory
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnimalCetagory $animalCetagory)
    {
        //
    }
}
