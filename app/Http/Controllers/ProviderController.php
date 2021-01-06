<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function providerList(){
        return view('provider')
            ->with('providers',Provider::all())
            ->with('provider_list','provider_list');
    }
    public function providerStore(Request $request){
       $request->validate([
           'providerName' => 'required',
           'password' => 'required|string|min:8',
       ]);
       $provider = new Provider();
       $provider->makeProvider($request->get('providerName'),$request->get('password'));
       $provider->save();
       return back()->with('success','Register new provider successful');
    }
}
