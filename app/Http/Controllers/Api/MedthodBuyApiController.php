<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MethodBuyResource;
use App\Models\MethodBuy;
use Illuminate\Http\Request;

class MedthodBuyApiController extends Controller
{
    public function methodBuy(){
        try {
            $methodBuy = MethodBuy::where('status',1)->latest()->first();
            $data = null;
            if($methodBuy != null){
                $data = MethodBuyResource::make(MethodBuy::where('status',1)->latest()->first());
            }

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
