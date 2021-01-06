<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProviderApiController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'provider_name' => 'required',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        $provider = Provider::where('provider_name',$request->provider_name)->first();
        if(! $provider || !Hash::check($request->password,$provider->password)){

            return response('This number is incorrect');
        }

        $provider->tokens()->delete();
        return $provider->createToken($request->device_name)->plainTextToken;

        //jay
    }
}
