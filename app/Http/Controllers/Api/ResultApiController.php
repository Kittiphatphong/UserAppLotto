<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Validator;

class ResultApiController extends Controller
{
    protected $ResultController;

    public function __construct(ResultController $resultController)
{
    $this->ResultController =$resultController;
}
   public function pullResult(Request $request){
       $validator = Validator::make($request->all(),[
           'draw' => 'required|unique:results',
           'l2d3d4d5d6d' => 'required|min:6|max:6',
           'animal1' => 'required|different:animal2|min:2|max:2',
           'animal2' => 'required||different:animal3|min:2|max:2',
           'animal3' => 'required|different:animal1|min:2|max:2',

       ]);
       if($validator->fails()){
           return response()->json([
               'status' => "false",
               'msg' => $validator->errors()
           ],422);
       }
        $this->ResultController->resultStore($request);
            return response()->json(['status' => true ,'msg' => 'Updated result successful'],201);
   }

   public function showResult(){
        $result = Result::with(['animal6drs','animal1rs','animal2rs','animal3rs'])->orderBy('draw','desc')->get();
//       $result = Result::with('animal6d1s' , 'jay')->orderBy('draw','desc')->get();
        return response()->json(['status' => true ,'data' => $result],200);
   }
}
