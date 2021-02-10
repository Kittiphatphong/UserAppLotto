<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    public function win2d3d4d5d6d(){
        $winOrders = Bill::orderBy('id','desc')->where('status_win',1)->where('type','2d3d4d5d6d')->get();
        return view('winner.win2d3d4d5d6d')
            ->with('win_2d3d4d5d6d','win_2d3d4d5d6d')
            ->with('orders',$winOrders);
    }

    public function win340(){
        $winOrders = Bill::orderBy('id','desc')->where('status_win',1)->where('type','3/40')->get();
        return view('winner.win340')
            ->with('win_340','win_340')
            ->with('orders',$winOrders);
    }
}
