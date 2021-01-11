<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;
class ResultController extends Controller
{
    public function resultList(){
        return view('result.resultList')
            ->with('result_list','result_list');
    }
    public function resultStore(Request $request){
        $result = new Result();
        dd($request->get('2d4d5d5d6d'));
    }
}
