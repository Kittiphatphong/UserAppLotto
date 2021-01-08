<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WinnerController extends Controller
{
    public function win2d3d4d5d6d(){
        return view('winner.win2d3d4d5d6d')
            ->with('win_2d3d4d5d6d','win_2d3d4d5d6d');
    }

    public function win340(){
        return view('winner.win340')
            ->with('win_340','win_340');
    }
}
