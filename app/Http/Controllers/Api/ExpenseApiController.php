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
            $countIncome = Expense::where('client_id',$customerId)->where('app_name','userapplotto')
                ->whereHas('typeExpenses',function ($q){
                    $q->where('income_expense',1);
                });
            $countExpense = Expense::where('client_id',$customerId)->where('app_name','userapplotto')
                ->whereHas('typeExpenses',function ($q){
                    $q->where('income_expense',0);
                });
            $categories_income = TypeExpense::where('client_id',$customerId)
                ->where('app_name','userapplotto')
                ->where('income_expense',1);
            $categories_expense = TypeExpense::where('client_id',$customerId)
                ->where('app_name','userapplotto')
                ->where('income_expense',0);



            //Date graph
            $date_graph =  Expense::join('type_expenses', 'expenses.type_expense_id', '=', 'type_expenses.id')
                ->where('expenses.client_id',$customerId)->where('expenses.app_name','userapplotto')
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
               $countIncome->whereBetween('date',[$from,$to]);
               $countExpense->whereBetween('date',[$from,$to]);
               $date_graph->whereBetween('date',[$from,$to]);
               $categories_income->whereHas('expenses',function ($q) use ($from,$to){
                   $q->whereBetween('date',[$from,$to]);
               });
           }

            //Category income
            $categoryIncome = [];
            foreach ($categories_income->get() as $category){
                $expense = $category->expenses;
                if($from != null && $to != null) {
                    $expense = $expense->whereBetween('date',[$from,$to]);
                }

               if($expense->count() > 0){
                   $array = [
                       "category" => $category->name ,

                       "percent" => number_format(($expense->sum('amount')*100) /$countIncome->sum('amount'),1 ),
                   ];
                   if($expense->count() > 0 && $category->income_expense == 1){
                       array_push($categoryIncome, $array);
                   }
               }


            }
            //Category expense
            $categoryExpense = [];
            foreach ($categories_expense->get() as $category){
                $expense = $category->expenses;
                if($from != null && $to != null) {
                    $expense = $expense->whereBetween('date',[$from,$to]);
                }

               if($expense->count()>0){
                   $array = [
                       "category" => $category->name ,

                       "percent" => number_format(($expense->sum('amount')*100) /$countExpense->sum('amount'),1 ),
                   ];
                   if($expense->count() > 0 && $category->income_expense == 0 ){
                       array_push($categoryExpense, $array);
                   }
               }


            }



            return response()->json([
               'status' => true,
               'total_income' => $totalIncome->sum('amount'),
               'total_expense' => $totalExpense->sum('amount'),
               'date_graph' => $date_graph->orderBy('date','asc')->get(),
               'category_income' => $categoryIncome ,
                'category_expense' => $categoryExpense ,
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
