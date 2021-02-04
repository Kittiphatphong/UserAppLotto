<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalApiController extends Controller
{
   public function animalList(){
       return response()->json([
          'status' =>true,
          'data' => Animal::with('animalNo')->get()
       ]);
   }
}
