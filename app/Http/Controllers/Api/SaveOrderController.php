<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SaveOrder6d;
use Illuminate\Http\Request;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\Validator;

class SaveOrderController extends Controller
{
    public function saveOrder6d(Request $request){
        $validator = Validator::make($request->all(),[
            'digit' =>'required',
            'money' =>'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'msg' => $validator->errors()
            ],422);
        }
        $customer = $request->user()->currentAccessToken()->tokenable;
       $save6d = new SaveOrder6d();
       $save6d->digit = $request->digit;
       $save6d->money = $request->money;
       $save6d->user_id = $customer->id;
       $save6d->save();
       return response()->json([
           'status' => true ,
           'data' => $save6d
       ],201);

    }
    public function update6d(Request $request){
        $validator = Validator::make($request->all(),[
            'id' =>'required',
            'money' =>'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'msg' => $validator->errors()
            ],422);
        }
        $data = SaveOrder6d::find($request->id);
        $data->money = $request->money;
        $data->save();
        return response()->json([
            'status' => true ,
            'data' => $data
        ],201);

    }
    public function deleteId6d(Request $request){
        $validator = Validator::make($request->all(),[
            'id' =>'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'msg' => $validator->errors()
            ],422);
        }
        $data = SaveOrder6d::find($request->id);
        $data->delete();
        return response()->json([
            'status' => true ,
            'msg' => 'Delete success'
        ],202);

    }
    public function updateUser6d(Request $request){

        try {
            $customer = $request->user()->currentAccessToken()->tokenable;
            $data = SaveOrder6d::where('user_id',$customer->id)->get();
            foreach ($data as $d){
                $save = SaveOrder6d::find($d->id);
                $save->money = $request->money;
                $save->save();
            }
            $data1 = SaveOrder6d::where('user_id',$customer->id)->get();
            return response()->json([
                'status' => true ,
                'data' => $data1
            ],200);
        }catch (\Throwable $e){
            return response()->json([
                'status' => false ,
                'data' => 'error'
            ],422);
        }

    }
    public function DeleteUser6d(Request $request){

        try {
            $customer = $request->user()->currentAccessToken()->tokenable;
            $data = SaveOrder6d::where('user_id',$customer->id)->get();
            foreach ($data as $d){
                $delete = SaveOrder6d::find($d->id);
                $delete->delete();
            }

            return response()->json([
                'status' => true ,
                'msg' => 'Delete success'
            ],202);
        }catch (\Throwable $e){
            return response()->json([
                'status' => false ,
                'data' => 'error'
            ],422);
        }

    }
    public function getSaveOrder(Request $request){
        try {
            $customer = $request->user()->currentAccessToken()->tokenable;
            $data = SaveOrder6d::where('user_id',$customer->id)->get();

            return response()->json([
                'status' => true ,
                'data' => $data
            ],200);
        }catch (\Throwable $e){
            return response()->json([
                'status' => false ,
                'data' => 'error'
            ],422);
        }
    }


}
