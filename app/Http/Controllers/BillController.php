<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function bill6d(){
        return view('billOrder.bill2d3d4d5d6d')
            ->with('bill_2d3d4d5d6d','bill_2d3d4d5d6d')
            ->with('bills',Bill::orderBy('id','desc')->where('type','2d3d4d5d6d')->get());
    }
    public function bill340(){
        return view('billOrder.bill340')
            ->with('bill_340','bill_340')
            ->with('bills',Bill::orderBy('id','desc')->where('type','3/40')->get());
    }
}
