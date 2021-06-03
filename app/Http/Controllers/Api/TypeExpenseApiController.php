<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TypeExpense;
use Illuminate\Http\Request;

class TypeExpenseApiController extends Controller
{
    public function typeExpenseList(){
        try {
            return response()->json([
               "status" => true,
               "data" => TypeExpense::select('id','name')->get()
            ]);


        }catch (\Exception $exception){
            return response()->json([
                "status" => false,
                "msg" => $exception->getMessage()
            ],422);
        }
    }
}
