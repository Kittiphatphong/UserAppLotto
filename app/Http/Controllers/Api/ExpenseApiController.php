<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ExpenseResource;

class ExpenseApiController extends Controller
{
    public function createExpense(Request $request){


        try {
            $customerId = $request->user()->currentAccessToken()->tokenable->id;
            $validator=  Validator::make($request->all(), [

                'amount' => 'required',
                'date' => 'required|date',
                'type_expense_id' => 'required|exists:type_expenses,id',
                'app_name' => 'required',

            ]);
            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "msg" => $validator->errors()->first(),
                ], 422);
            }

            $expense = Expense::create([
                'amount' => $request->amount,
                'date' => $request->date,
                'type_expense_id' => $request->type_expense_id,
                'app_name' => $request->app_name,
                'client_id' => $customerId,
            ]);
            if($request->description != null){
                $expense->description = $request->description;
                $expense->save();
            }

            return response()->json([
               "status" => true,
               "msg" => "Created successful",
               'data' => ExpenseResource::make($expense)
            ],201);




        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => $e->getMessage()
            ],422);
        }

    }


    public function deleteExpense(Request $request){
        try{
            $customerId = $request->user()->currentAccessToken()->tokenable->id;
            $validator=  Validator::make($request->all(), [
                'expense_id' => 'required|exists:expenses,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "msg" => $validator->errors()->first(),
                ], 422);
            }
            $expense = Expense::find($request->expense_id);

            if($customerId === $expense->client_id ){
                $expense->delete();
                return response()->json([
                    "status" => true,
                    "msg" => "Deleted successful",
                    "data" =>  ExpenseResource::make($expense),
                ]);
            }



        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => $e->getMessage()
            ],422);
        }
    }

    public function editExpense(Request $request){
        try{
            $customerId = $request->user()->currentAccessToken()->tokenable->id;
            $validator=  Validator::make($request->all(), [
                'expense_id' => 'required|exists:expenses,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "msg" => $validator->errors()->first(),
                ], 422);
            }
            $expense = Expense::find($request->expense_id);

            if($customerId === $expense->client_id ){
                $expense->amount = $request->amount;
                $expense->date = $request->date;
                $expense->type_expense_id = $request->type_expense_id;
                $expense->description = $request->description;
                $expense->save();
                return response()->json([
                    "status" => true,
                    "msg" => "Edited successful",
                    "data" =>  ExpenseResource::make($expense),
                ]);
            }



        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => $e->getMessage()
            ],422);
        }
    }

    public function expenseDataCustomer(Request $request){
        try {
            $customerId = $request->user()->currentAccessToken()->tokenable->id;
            $validator=  Validator::make($request->all(), [
            'date_from' => 'date',
            'date_to' => 'date'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "msg" => $validator->errors()->first(),
                ], 422);
            }
            $expenseList = Expense::where('client_id',$customerId)->where('app_name','userapplotto');
            $from = $request->date_from;
            $to = $request->date_to;

           if($from != null && $to != null){
              $expenseList->whereBetween('date',[$from,$to]);
           }


            return response()->json([
               'status' => true,
               'data' => ExpenseResource::collection($expenseList->latest()->get())
            ]);


        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => $e->getMessage()
            ],422);
        }
    }
}
