<?php

namespace App\Http\Controllers;

use App\Models\BillOrder;
use App\Models\Customer;
use App\Models\Result;
use Illuminate\Http\Request;

class BillOrderController extends Controller
{
   public function bill6d(){
       return view('billOrder.bill2d3d4d5d6d')
           ->with('bill_2d3d4d5d6d','bill_2d3d4d5d6d')
           ->with('customers',Customer::all())
           ->with('draws',Result::select('draw')->orderBy('id','desc')->get())
           ->with('bills',BillOrder::orderBy('id','desc')->where('type','2d3d4d5d6d')->get());
   }
   public function bill340(){
       return view('billOrder.bill340')
           ->with('bill_340','bill_340')
           ->with('draws',Result::select('draw')->orderBy('id','desc')->get())
           ->with('customers',Customer::all())
           ->with('bills',BillOrder::orderBy('id','desc')->where('type','3/40')->get());
   }
}
