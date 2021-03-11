<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\Dreamteller;
use App\Models\Promotion;
use App\Models\RecommentLotto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard(){
        $customerActive = DB::table('bills')->where('created_at','>=',Carbon::now()->subDay(7))->groupBy('customer_id')->pluck('customer_id')->toArray();
        return view('dashboard')
            ->with('dashboard','dashboard')
            ->with('customers',[count($customerActive),Customer::all()->count()])
            ->with('recommends',RecommentLotto::orderBy('id','desc')->first()->recommendImages)
            ->with('promotions',Promotion::all())
            ->with('animals',Animal::all())
            ->with('dreamTellers',Dreamteller::all());
    }
}
