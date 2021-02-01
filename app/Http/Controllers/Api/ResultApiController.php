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
        return response("updated result success");
   }

   public function showResult(){
        $result = Result::orderBy('draw','desc')->get();
        return response()->json($result);
   }
}
