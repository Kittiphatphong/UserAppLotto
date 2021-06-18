<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Trail\RandomLuckyNumber;

class RandomDigitApiController extends Controller
{
    use RandomLuckyNumber;
    public function randomDigit(Request $request){

        try {
            $validator = Validator::make($request->all(),[
                'set_amount' => 'numeric|required',
                'category' => 'required',
                'type' => 'numeric|required',
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'msg' => $validator->errors()->first()
                ],422);
            }

            return response()->json([
                'status' => true,
                'data' => $this->luckyRandom($request->set_amount,$request->type,$request->category)
            ]);

        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => $e->getMessage()
            ],422);
        }



    }
}
