<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\OTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SendMassageController extends Controller
{
    public function sendOTP($phone , $content){

//        $response = Http::post("http://ncclaolotto.com:9008/index.php?r=sms/send",
//            [
//                "jwt_key"=>"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjozMCwidXNlcm5hbWUiOiJuY2Nfc2VuZF9zbXMiLCJpcGFkZHIiOiIiLCJqd3Rfc3RhcnQiOiIyMDIxLTAxLTE0IDExOjM3OjAyIiwiand0X2V4cGlyZSI6IjIwMjEtMDEtMTQgMTE6Mzc6MDIifQ.vLHCg1u5NkmgXuwqsqXvx9goDJtLk__coPWhFlcwOW8",
//                "phone_number"=>$phone,
//                "content"=>$content
//            ]);

        $customer = Customer::where('phone',$phone)->first();
        $otp = OTP::where('customer_id',$customer->id)->first();
        $otp->limit_request = $otp->limit_request +1;
        $otp->save();

    }
}
