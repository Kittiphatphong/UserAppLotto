<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MethodBuyCategoryResource;
use App\Models\MethodBuy;
use App\Models\MethodBuyCategory;
use Illuminate\Http\Request;

class MedthodBuyApiController extends Controller
{
    public function methodBuy(){
        try {

                $data = MethodBuyCategoryResource::collection(MethodBuyCategory::all());

            return response()->json([
            'status' => true,
            'data'=> $data
            ]);

        }catch (\Exception $e){
            return response()->json([
               'status' => true,
               'msg' => $e->getMessage()
            ]);
        }
}
}
