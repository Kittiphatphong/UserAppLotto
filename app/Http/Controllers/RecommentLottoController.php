<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecommentLottoController extends Controller
{
    public function recommendList(){
        return view('recommend.recommendList')
            ->with('recommend_list','recommend_list');
    }
}
