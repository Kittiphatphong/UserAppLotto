<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedthodBuyApiController extends Controller
{
    public function methodBuy(){
        try {
            return response()->json([

            ]);

        }catch (\Exception $e){
            return response()->json([
               'status' => true,
               'msg' => $e->getMessage()
            ]);
        }
}
}
