<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionApiController extends Controller
{
    public function promotionList(){
        return response()->json([
            'status' => true,
            'data' => Promotion::all()
        ]);
    }
}
