<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpenseApiController extends Controller
{
    public function createExpense(Request $request){

        try {

            $validator=  Validator::make($request->all(), [

                'amount' => 'required',
                'income_expense' => 'required',
                'date' => 'required|date',
                'type_expense_id' => 'required|exists:type_expenses,id',
                'app_name' => 'required',
                'client_id' => 'required'

            ]);
            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "msg" => $validator->errors()->first(),
                ], 422);
            }

            $expense = Expense::create($request->all());

            return response()->json([
               "status" => true,
               'data' => $expense
            ],201);




        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => $e->getMessage()
            ],422);
        }

    }
}
