<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\TypeExpense;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ExpenseResource;
use App\Http\Resources\TypeExpenseResource;
use Illuminate\Support\Facades\DB;
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
            //Get id customer
            $customerId = $request->user()->currentAccessToken()->tokenable->id;

            //Filter date
            $from = $request->date_from;
            $to = $request->date_to;

            //data
            $expenseList = Expense::where('client_id',$customerId)->where('app_name','userapplotto');

            //total
            $totalIncome = Expense::where('client_id',$customerId)->where('app_name','userapplotto')->whereHas('typeExpenses',function ($q){
                $q->where('income_expense',1);
            });
            $totalExpense = Expense::where('client_id',$customerId)->where('app_name','userapplotto')->whereHas('typeExpenses',function ($q){
                $q->where('income_expense',0);
            });

            //Category
            $countExpense = Expense::latest();

            $categories = TypeExpense::where('client_id',$customerId)
                ->orWhere('client_id',null)->orWhere('app_name',null)
                ->where('app_name','userapplotto');


            //Date graph
            $date_graph =  Expense::join('type_expenses', 'expenses.type_expense_id', '=', 'type_expenses.id')
                ->groupBy('date')
                ->select('date',
                    DB::raw("sum(CASE WHEN type_expenses.income_expense = 1 THEN amount ELSE 0 END) as income"),
                    DB::raw("sum(CASE WHEN type_expenses.income_expense = 0 THEN amount ELSE 0 END) as expense"),
                );


           if($from != null && $to != null){
               $expenseList->whereBetween('date',[$from,$to]);
               $totalIncome->whereBetween('date',[$from,$to]);
               $totalExpense->whereBetween('date',[$from,$to]);
               $totalExpense->whereBetween('date',[$from,$to]);
               $countExpense->whereBetween('date',[$from,$to]);
               $date_graph->whereBetween('date',[$from,$to]);
           }

            //Category
            $categoryPercent = [];
            foreach ($categories->get() as $category){
                $expense = $category->expenses;
                if($from != null && $to != null) {
                    $expense = $expense->whereBetween('date',[$from,$to]);
                }
                if($category->income_expense == 1){
                    $type = "income";
                }else{
                    $type = "expense";
                }

                $array = [
                    "category" => $category->name ,
                    "income_expense" => $category->income_expense,
                    "type" => $type,
                    "percent" => round(($expense->count()*100) /$countExpense->count()) ,
                ];
                array_push($categoryPercent, $array);
            }
            //Category



            return response()->json([

               'status' => true,
               'total_income' => $totalIncome->sum('amount'),
               'total_expense' => $totalExpense->sum('amount'),
               'date_graph' => $date_graph->get(),
               'category' => $categoryPercent,
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
