<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PushNotificationController;
use App\Models\Bill;
use App\Models\BillOrder;
use App\Models\Billorder2d3d4d5d6d;
use App\Models\Billorder340;
use App\Models\Customer;
use App\Models\Customer_Notification;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillApiController extends Controller
{
    protected $PushNotificationController;
    public function __construct(PushNotificationController $pushNotificationController)
    {
        $this->PushNotificationController = $pushNotificationController;
    }


    public function sell6d(Request $request){
        $validator = Validator::make($request->all(),[
            'phone_no' => 'required|min:10|max:10|exists:customers,phone',
            'bill_number' => 'required|unique:bills',
            'draw' => 'numeric|required',
            'money' => 'numeric|required',
            'digit' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'msg' => $validator->errors()
            ],422);
        }

        $customer = Customer::where('phone',$request->phone_no)->first();

        $type = "2d3d4d5d6d";
        $bill = new Bill();
        $bill->newBill($customer->id,$request->bill_number,$request->draw,$type,$request->money,json_decode($request->digit));

        $body = str_replace('"','',implode(',',$bill->digit)) ." = ". number_format($bill->money). "Lak";
        $title = "Buy lotto 6D";
        $this->PushNotificationController->pushNotificationBuy($body , $title,1, $customer->id,$bill);

        return response()->json([
            'status' => true,
            'data'   => $bill
        ],201);

    }

    public function sell340(Request $request){
        $validator = Validator::make($request->all(),[
            'phone_no' => 'required|min:10|max:10|exists:customers,phone',
            'bill_number' => 'required|unique:bills',
            'draw' => 'numeric|required',
            'money' => 'numeric|required',
            'digit' => 'required|json'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'msg' => $validator->errors()
            ],422);
        }

        $customer = Customer::where('phone',$request->phone_no)->first();
        $type = "3/40";
        $bill = new Bill();

        $bill->newBill($customer->id,$request->bill_number,$request->draw,$type,$request->money,json_decode($request->digit));

        $body = str_replace('"','',implode(',',$bill->digit)) ." = ". number_format($bill->money). "Lak";
        $title = "Buy lotto 3/40";
        $this->PushNotificationController->pushNotificationBuy($body , $title,1, $customer->id,$bill);
        return response()->json([
            'status' => true,
            'data'   => $bill
        ],201);

    }
    public function billList(Request $request){

        $customerid = $request->user()->currentAccessToken();

        $bills = Bill::orderBy('id','desc')->where('customer_id',$customerid->tokenable->id)->get();

        return response()->json([
            'status' => true,
            'data' =>  $bills
        ]);
    }

    public function billDetail(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required|exists:bills,id',
            'noti_id' => 'required|exists:customer__notifications,id'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'msg' => $validator->errors()
            ],422);
        }

        $bills = Bill::find($request->id);
        $customer_notification = Customer_Notification::find($request->noti_id);
        $customer_notification->read_status = 1;
        $customer_notification->save();


        return response()->json([
            'status' => true,
            'data' => $bills
        ]);
    }
}
