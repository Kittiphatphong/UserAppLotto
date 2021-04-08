<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function index(){

       $logs = Activity::all();
        return view('log.index')
            ->with('log_index_customer',$logs);
    }
}
