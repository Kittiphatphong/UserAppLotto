<?php

namespace App\Http\Controllers;

use App\Models\TermCondition;
use Illuminate\Http\Request;

class TermConditionApiController extends Controller
{
    public function term(){
        try {
            $term = TermCondition::first()->select('title','content')->get();
            return response()->json(['status' => true , 'data' => $term]);
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => $e->getMessage()
            ],422);
        }
    }
}
