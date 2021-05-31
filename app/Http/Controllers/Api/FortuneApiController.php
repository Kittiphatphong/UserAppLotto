<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Temple;
use Illuminate\Http\Request;
use App\Http\Resources\TempleResource;
use Illuminate\Support\Facades\Validator;

class FortuneApiController extends Controller
{
    public function templeList(){
        return response()->json([
            'status' => true,
            'data' => TempleResource::collection(Temple::latest()->get())
        ]);
    }
    public function getPaperFortune(Request $request){

        $validator=  Validator::make($request->all(), [
            'id_temple' => 'required | exists:temples,id',

        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "msg" => $validator->errors()->first(),
            ], 422);
        }else{
            return response()->json([
                'status' => true,
                'data' => Temple::find($request->id_temple)->apiFortunes
            ]);
        }


    }
}
