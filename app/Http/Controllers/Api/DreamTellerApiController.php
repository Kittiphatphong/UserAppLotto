<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dreamteller;
use Illuminate\Http\Request;

class DreamTellerApiController extends Controller
{
   public function dreamTellerList(){
       return response()->json([
           'status' => true,
           'data' => Dreamteller::with('dreamTellerImages')->get()
       ]);
   }
}
