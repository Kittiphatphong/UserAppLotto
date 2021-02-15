<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Dreamteller;
use App\Models\Promotion;
use App\Models\RecommentLotto;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('dashboard')
            ->with('dashboard','dashboard')
            ->with('recommends',RecommentLotto::orderBy('id','desc')->first()->recommendImages)
            ->with('promotions',Promotion::all())
            ->with('animals',Animal::all())
            ->with('dreamTellers',Dreamteller::all());
    }
}
