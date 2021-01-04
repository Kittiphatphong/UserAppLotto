<?php

namespace App\Http\Controllers;

use App\Models\OTP;
use Illuminate\Http\Request;
use App\Models\Customer;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
class CustomerController extends Controller
{
    public function customerList(){
        session()->flash('customer.list');
        return view('customers.customerList')
            ->with('customers',Customer::all());


    }
    public function customerStore(Request $request){
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:customers',
            'birthday' => 'required',
            'password' => 'required|string|min:8',
        ]);
          $customer = new Customer();
       $customer->makeCustomer($request->firstname,$request->lastname,$request->phone,$request->password,$request->birthday,$request->gender);
        $customer->save();
        return back();

    }
}
