<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TypeExpense;
use Illuminate\Http\Request;
use App\Http\Resources\TypeExpenseResource;
use Illuminate\Support\Facades\Validator;

class TypeExpenseApiController extends Controller
{
    public function typeExpenseList(Request $request){
        try {
            $customerId = $request->user()->currentAccessToken()->tokenable->id;
            $data = TypeExpense::where('client_id',$customerId)
                ->orWhere('client_id',null)->orWhere('app_name',null)
                ->where('app_name','userapplotto')->latest()->get();
            return response()->json([
               "status" => true,
               "data" => TypeExpenseResource::collection($data)
            ]);


        }catch (\Exception $exception){
            return response()->json([
                "status" => false,
                "msg" => $exception->getMessage()
            ],422);
        }
    }

    public function createTypeExpense(Request $request){
        try {
            $validator=  Validator::make($request->all(), [
                'name' => 'required',
                'income_expense' => 'required|numeric|min:0|max:1',
                'app_name' => 'required',

            ]);
            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "msg" => $validator->errors()->first(),
                ], 422);
            }

            $customerId = $request->user()->currentAccessToken()->tokenable->id;

            $typeExpense = new TypeExpense();
            $typeExpense->name = $request->name;
            $typeExpense->income_expense = $request->income_expense;
            $typeExpense->app_name = $request->app_name;
            $typeExpense->client_id = $customerId;
            $typeExpense->save();

            return response()->json([
                "status" => true,
                "data" => TypeExpenseResource::make($typeExpense)
            ]);


        }catch (\Exception $exception){
            return response()->json([
                "status" => false,
                "msg" => $exception->getMessage()
            ],422);
        }
    }


    public function editTypeExpense(Request $request){
        try {
            $validator=  Validator::make($request->all(), [
                'type_expense_id' => 'required',
                'name' => 'required',
                'income_expense' => 'required|numeric|min:0|max:1',

            ]);
            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "msg" => $validator->errors()->first(),
                ], 422);
            }

            $customerId = $request->user()->currentAccessToken()->tokenable->id;

            $typeExpense = TypeExpense::find($request->type_expense_id);

            if($customerId == $typeExpense->client_id){
                $typeExpense->name = $request->name;
                $typeExpense->income_expense = $request->income_expense;
                $typeExpense->save();
                return response()->json([
                    "status" => true,
                    "msg" => "edit successful",
                    "data" => TypeExpenseResource::make($typeExpense)
                ]);
            }else{
                return response()->json([
                    "status" => false,
                    "msg" => "Type expense not match with this customer"
                ],422);
            }


        }catch (\Exception $exception){
            return response()->json([
                "status" => false,
                "msg" => $exception->getMessage()
            ],422);
        }
    }


    public function deleteTypeExpense(Request $request){
        try {
            $validator=  Validator::make($request->all(), [
                'type_expense_id' => 'required|exists:type_expenses,id',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "msg" => $validator->errors()->first(),
                ], 422);
            }

            $customerId = $request->user()->currentAccessToken()->tokenable->id;
            $typeExpense = TypeExpense::find($request->type_expense_id);

            if($customerId == $typeExpense->client_id){
                $typeExpense->delete();
                return response()->json([
                    "status" => true,
                    "msg" => "deleted successful",
                    "data" => TypeExpenseResource::make($typeExpense)
                ]);
            }else{
                return response()->json([
                    "status" => false,
                    "msg" => "Type expense not match with this customer"
                ],422);
            }

        }catch (\Exception $exception){
            return response()->json([
                "status" => false,
                "msg" => $exception->getMessage()
            ],422);
        }
    }
}
