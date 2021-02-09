<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BillOrder;
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
       if(round($request->animal1)>40 || round($request->animal2)>40 || round($request->animal3)>40){
           return response()->json([
               'status' => "false",
               'msg' => ["draw"=> ["3/40 not more than 40."]]
           ],422);

       }
       if(BillOrder::where('draw',$request->get('draw'))->count() <= 0 ){
           return response()->json([
               'status' => "false",
               'msg' => ["draw"=> ["This draw is not exist"]]
           ],422);
       }

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
        return response()->json(['status' => true ,'data' => $result],200);
   }

   public function filterResult(Request $request){
       $validator = Validator::make($request->all(),[
           'draw' => 'required|numeric|exists:results,draw',
       ]);
       if($validator->fails()) {
           return response()->json([
               'status' => "false",
               'msg' => $validator->errors()
           ], 422);
       }
       $result = Result::with(['animal6drs','animal1rs','animal2rs','animal3rs'])->where('draw',$request->draw)->get();
       return response()->json(['status' => true ,'data' => $result],200);
   }

}
