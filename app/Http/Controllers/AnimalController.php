<?php

namespace App\Http\Controllers;

use App\Models\AnimalNo;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AnimalController extends Controller
{
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
            'detail' => 'required',
            'detailNo' => 'required',
            'image' => 'required|file|image|max:50000|mimes:jpeg,png,jpg',
            'animal' => 'required|unique:animal_nos,no|min:2|max:2',

        ]);
        if(round($request->animal)<=0 && round($request->animal)>40){
            return back()->with('warning','no incorrect');
        }

        $stringImageReformat = base64_encode('_'.time());
        $ext = $request->file('image')->getClientOriginalExtension();
        $imageName = $stringImageReformat.".".$ext;
        $imageEncode = File::get($request->image);


        $animal = new Animal();
        $animal->name = $request->name;
        $animal->detail = $request->detail;
        $animal->image = "/storage/animal_image/".$imageName;
        $animal->number = "[".$request->detailNo."]";
        $animal->save();

        $animalNo = new AnimalNo();
        $animalNo->no = $request->animal;
        $animalNo->animal_id = $animal->id;
        $animalNo->save();

        $getAnimal = round($request->animal)+40;

        while($getAnimal<=100){

            $animalNo = new AnimalNo();

            if($getAnimal == 100){
                $animalNo->no = "00";
            }else{
                $animalNo->no = $getAnimal;
            }
            $animalNo->animal_id = $animal->id;
            $animalNo->save();

            $getAnimal+=40;
        }

        Storage::disk('local')->put('public/animal_image/'.$imageName, $imageEncode);
        return back()->with('success','success');
    }

}
