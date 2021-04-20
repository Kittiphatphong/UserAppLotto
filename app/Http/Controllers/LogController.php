<?php

namespace App\Http\Controllers;

use AWT\Contracts\ApiLoggerInterface;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function index(){

       $logs = Activity::all();
       $text_success = ['created','new customer'];
       $text_info = ['updated','login','set password','verify otp',
           'forgot password','changed password','updated detail',
           'updated background','updated profile','request otp','change role','role update permission','role add permission','restore'
       ];
       $text_waring = ['edited'];
        return view('log.index')
            ->with('log_index_customer',$logs)
            ->with('text_success',$text_success)
            ->with('text_info',$text_info)
            ->with('text_warning',$text_waring);
    }

    public function indexApi(ApiLoggerInterface $logger)
    {
        $apilogs = $logger->getLogs();

        if(count($apilogs)>0){
            $apilogs = $apilogs->sortByDesc('created_at');
        }
        else{
            $apilogs = [];
        }
        return view('log.indexLog',compact('apilogs'));

    }
}
