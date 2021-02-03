<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecommentLottoController extends Controller
{
    public function recommendList(){
        return view('recommend.recommendList')
            ->with('recommend_list','recommend_list');
    }
    public function recommendCreate(){
        return view('recommend.recommendCreate')
            ->with('recommend_create','recommend_create');
    }
}
