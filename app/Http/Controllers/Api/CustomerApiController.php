<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class CustomerApiController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'phone' => 'required',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        $customer = Customer::where('phone',$request->phone)->first();
    if(! $customer || !Hash::check($request->password,$customer->password)){
        throw ValidationException::withMessages([
            'phone' => ['The provided credentials are incorrect.'],
        ]);
    }
    $customer->tokens()->delete();
    return $customer->createToken($request->device_name)->plainTextToken;
    }

    public function register(Request $request){
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|max:10|min:10|unique:customers',
            'birthday' => 'required',
            'password' => 'required|string|min:8',
        ]);
        $customer = new Customer();
        $customer->makeCustomer($request->firstname,$request->lastname,$request->phone,$request->password,$request->birthday,$request->gender);
        $customer->save();
        return response()->json($customer);
    }
}
