<?php

namespace App\Http\Controllers;

use App\Models\AnimalNo;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Trail\UploadImage;

class AnimalController extends Controller
{
    use UploadImage;
    public function animalList(){

        return view('animal.animalList')
            ->with('animal_list',Animal::all());
    }
    public function animalCrate(){
        return view('animal.animalCreate')
        ->with('animal_create','animal_create');
    }
    public function animalStore(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'digit' => 'required',
            'image' => 'required|file|image|max:50000|mimes:jpeg,png,jpg',
            'animalDigit' => 'required|unique:animal_nos,animal_digit|min:2|max:2',

        ]);
        if(round($request->animalDigit)<=0 && round($request->animalDigit)>40){
            return back()->with('warning','no incorrect');
        }



        $pieces = explode(",", $request->digit);


        $animal = new Animal();
        $animal->name = $request->name;
        $animal->description = $request->description;
        $animal->image = $this->upload($request,"animal_image");
        $animal->digit = $pieces;
        $animal->save();

        $animalNo = new AnimalNo();
        $animalNo->animal_digit = $request->animalDigit;
        $animalNo->animal_id = $animal->id;
        $animalNo->save();

        $getAnimal = round($request->animalDigit)+40;

        while($getAnimal<=100){

            $animalNo = new AnimalNo();

            if($getAnimal == 100){
                $animalNo->animal_digit = "00";
            }else{
                $animalNo->animal_digit = $getAnimal;
            }
            $animalNo->animal_id = $animal->id;
            $animalNo->save();

            $getAnimal+=40;
        }

        $animal->animals_digit = $animal->animalNos->pluck('animal_digit');
        $animal->save();

        return back()->with('success','success');
    }
    public function animalEdit($id){
        $animal = Animal::find($id);
        return view('animal.animalCreate',compact('animal'))
            ->with('animal_list','animal_create');
    }

    public function animalUpdate(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'digit' => 'required',
            'image' => 'file|image|max:50000|mimes:jpeg,png,jpg',
        ]);


        $pieces = explode(",", $request->digit);
        $animal = Animal::find($id);
        $animal->name = $request->name;
        $animal->description = $request->description;
        $animal->digit = $pieces;


        if($request->hasFile("image")){
            Storage::delete("public/animal_image/".str_replace('/storage/animal_image/','',$animal->image));
            $animal->image = $this->upload($request,"animal_image");
        }
        $animal->save();
        return redirect()->route('animal.list')->with('success','Update success');
    }

}
