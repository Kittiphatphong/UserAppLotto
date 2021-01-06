<?php

namespace App\Http\Controllers;

use App\Models\OTP;
use Illuminate\Http\Request;
use App\Models\Customer;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
class CustomerController extends Controller
{
    public function customerList(){

        return view('customers.customerList')
            ->with('customers',Customer::all())
            ->with('customer_list','customer_list');
    }

    public function customerRegister(){
        return view('customers.customerRegister')
            ->with('customer_register','customer_register');
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
       $otp = new OTP();
       $otp->status = 1;
       $otp->customer_id = $customer->id;
       $otp->otp_number = rand(100000,999999);
       $otp->save();
        return back()->with('success','Register new customer successful');
    }
    public function customerDelete($id){
        $customer= Customer::find($id);
        $customer->delete();
        return back()->with('success','Deleted customer successful');
    }
}
