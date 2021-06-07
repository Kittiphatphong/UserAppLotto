<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AirTimeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SendMassageController;
use App\Models\Customer;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\PushNotificationController;
use Illuminate\Support\Facades\Validator;

class PushNotificationApiController extends Controller
{
    protected $PushNotificationController;
    public function __construct(PushNotificationController $pushNotificationController)
    {
        $this->PushNotificationController = $pushNotificationController;
    }

    public function notificationBuyForAllChanel(Request $request)
    {
        try {


            $validator = Validator::make($request->all(), [
                'code' => 'required|array',
                'bill_number' => 'required',
                'amount' => 'required',
                'phone' => 'required|min:9|max:10|exists:customers,phone',


            ]);
            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "msg" => $validator->errors()->first(),
                ], 422);
            }
                $customer_id = Customer::where('phone',$request->phone)->first()->id;


                $this->PushNotificationController->pushNotificationBuy(json_encode($request->code), "Buy lotto", 1, $customer_id, $request->all() ,$request->bill_number);
                return response()->json([
                    "status" => true ,
                    "msg" => "Push notification successful"
                ]);


        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => $e->getMessage()
            ],500);
        }

    }
}
