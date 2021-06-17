<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\AnimalCetagory;
use Illuminate\Http\Request;
use App\Http\Resources\AnimalCategoryResource;

class AnimalApiController extends Controller
{
   public function animalList(){
       return response()->json([
          'status' =>true,
          'data' => Animal::all()
       ]);
   }

    public function animalCategory(){
        return response()->json([
            'status' =>true,
            'data' => AnimalCategoryResource::collection(AnimalCetagory::all())
        ]);
    }
}
