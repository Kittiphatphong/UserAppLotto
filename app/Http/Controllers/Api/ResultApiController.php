<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\ResultController;

class ResultApiController extends Controller
{
    protected $ResultController;

    public function __construct(ResultController $resultController)
{
    $this->ResultController =$resultController;
}
   public function pullResult(Request $request){
        $this->ResultController->resultStore($request);
            return response()->json(['status' => true ,'msg' => 'Updated result successful'],201);
   }

   public function showResult(){
        $result = Result::orderBy('draw','desc')->get();
        return response()->json(['status' => true ,'data' => $result],200);
   }
}
