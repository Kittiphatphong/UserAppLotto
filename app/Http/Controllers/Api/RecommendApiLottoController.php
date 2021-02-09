<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RecommentLotto;
use Illuminate\Http\Request;

class RecommendApiLottoController extends Controller
{
    public function recommendList(){

        return response()->json([
           'status' => true ,
            'data' => RecommentLotto::with('recommendImages')->orderBy('id','desc')->first()
        ]);
    }
}
