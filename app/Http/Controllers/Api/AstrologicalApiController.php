<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Astrological;
use Illuminate\Http\Request;
use App\Http\Resources\AstrologicalResource;

class AstrologicalApiController extends Controller
{
    public function astrological(){
        try {

            return response()->json([
               'status' => true,
               'data' =>  Astrological::where('status',1)->get()
            ]);

        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg'=> $e->getMessage()
            ],422);
        }
    }
}
