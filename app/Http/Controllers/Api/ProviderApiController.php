<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class ProviderApiController extends Controller
{
    public function login(Request $request){
        $validator =  Validator::make($request->all(),[
            'provider_name' => 'required|exists:providers,provider_name',
            'password' => 'required|min:8',
            'device_name' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
               'status' => "false",
                'msg' => $validator->errors()
            ],422);
        }
        $provider = Provider::where('provider_name',$request->provider_name)->first();
        if(! $provider || !Hash::check($request->password,$provider->password)){

            return response()->json([
                'status' => "false",
                'msg' => ['password'=>'Password is incorrect'],
            ],422);;
        }

        $provider->tokens()->delete();
        return $provider->createToken($request->device_name)->plainTextToken;


    }
}
