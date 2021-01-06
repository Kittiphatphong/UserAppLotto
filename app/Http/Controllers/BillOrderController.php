<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillOrderController extends Controller
{
   public function bill2d3d4d5d6d(){
       return view('billOrder.bill2d3d4d5d6d')
           ->with('bill_2d3d4d5d6d','bill_2d3d4d5d6d');

   }
   public function bill340(){
       return view('billOrder.bill340')
           ->with('bill_340','bill_340');
   }
}
