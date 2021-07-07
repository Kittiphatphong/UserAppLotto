<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\AnimalCetagory;
use App\Models\AnimalWithCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Trail\UploadImage;
use Illuminate\Support\Facades\Storage;

class AnimalCetagoryController extends Controller
{
    use UploadImage;
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
            ->with('animal_category','animal_category')
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
       'name' => 'required|unique:animal_cetagories,name',
        'animals' => 'required',
        'image' => 'required|file|image|max:50000|mimes:jpeg,png,jpg'
    ]);
    $animalCategory = new AnimalCetagory();
    $animalCategory->name = $request->name;
    $animalCategory->image = $this->upload($request,"animal_category_image");
    $animalCategory->save();

        foreach ($request->animals as $animal){
            $animalWithCategory = new AnimalWithCategory();
            $animalWithCategory->animal_id = $animal;
            $animalWithCategory->animal_category_id = $animalCategory->id;
            $animalWithCategory->save();
        }

        return redirect()->route('animal-category.index')->with('success','Create successful');
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
    public function edit($id)
    {
        return view('animalCategory.animalCategoryCreate')
            ->with('animal_category','animal_category')
            ->with('animals',Animal::all())
            ->with('edit',AnimalCetagory::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnimalCetagory  $animalCetagory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'animals' => 'required',
            'image' => 'file|image|max:50000|mimes:jpeg,png,jpg'
        ]);
        $animalCategory = AnimalCetagory::find($id);
        $animalCategory->name = $request->name;
        if($request->hasFile("image")) {
            Storage::delete("public/animal_category_image/" . str_replace('/storage/animal_category_image/', '', $animalCategory->image));
            $animalCategory->image = $this->upload($request,"animal_category_image");
        }
        $animalCategory->save();
        DB::table('animal_with_categories')->where('animal_category_id',$id)->delete();

        foreach ($request->animals as $animal){
            $animalWithCategory = new AnimalWithCategory();
            $animalWithCategory->animal_id = $animal;
            $animalWithCategory->animal_category_id = $animalCategory->id;
            $animalWithCategory->save();
        }

        return redirect()->route('animal-category.index')->with('success','Update successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnimalCetagory  $animalCetagory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $animalCategory = AnimalCetagory::find($id);
        $animalCategory->delete();
        return redirect()->route('animal-category.index')->with('success','Delete successful');

    }
}
