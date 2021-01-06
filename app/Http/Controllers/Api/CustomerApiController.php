<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\OTP;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
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

        return response('This number is incorrect');
    }
        if( $customer->otps->status != 1){
            return response('This number is not verify');
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
        $this->requestOTP($customer->id);
        return response()->json([$customer,$customer->otps]);
    }

    public function requestOTP($id){
    $otps = OTP::where('customer_id',$id)->pluck('id');
    if ($otps->count() > 0){
        $otp = OTP::find($otps->first());
        if($otp->status == 1){
            return response('This number is verify');
        }
    }else{
        $otp = new OTP();
    }
        $otp->customer_id = $id;
        $otp->otp_number = rand(100000,999999);
        $otp->save();
        return response($otp->otp_number);
    }

    public function verifyOTP(Request $request,$id){
        $request->validate([
            'otp_verify' => 'required|numeric'
        ]);
    $customer = Customer::find($id);
    $start = $customer->otps->updated_at->addMinutes(2);
    //Check OTP number

    if($request->otp_verify == $customer->otps->otp_number){
        if($start->lt(Carbon::now('Asia/Vientiane'))){
            return response('OTP is expired');
        }

        $otps = OTP::where('customer_id','=',$id)->pluck('id');
        $otp = OTP::find($otps->first());
        $otp->status = 1;
        $otp->save();
            return response('success');
    }else{
        return response('OTP is incorrect');
    }
    }
}
