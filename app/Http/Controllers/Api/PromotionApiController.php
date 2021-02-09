<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromotionApiController extends Controller
{
    public function promotionList(){
        return response()->json([
            'status' => true,
            'data' => Promotion::all()
        ]);
    }
    public function promotionFilter(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required|exists:promotions,id'
        ]);
        $promotion =  Promotion::find($request->id);
        if($validator->fails()){
            return response()->json([
                'status' => "false",
                'msg' => $validator->errors()
            ],422);
        }
        return response()->json([
            'status' => true,
            'data' => $promotion
        ]);
    }

}
