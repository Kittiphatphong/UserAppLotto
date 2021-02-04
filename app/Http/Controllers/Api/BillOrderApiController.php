<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BillOrder;
use App\Models\Billorder2d3d4d5d6d;
use App\Models\Billorder340;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\PushNotificationController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class BillOrderApiController extends Controller
{
    protected $PushNotificationController;
    public function __construct(PushNotificationController $pushNotificationController)
    {
        $this->PushNotificationController = $pushNotificationController;
    }

    public function billOrder($bill_number,$draw,$customer,$type){
        $order = new BillOrder();
        $order->customer_id = $customer;
        $order->bill_number = $bill_number;
        $order->draw = $draw;
        $order->type = $type;
        $order->save();
        return $order;
    }

    public function sell2d3d4d5d6d(Request $request){
         $validator = Validator::make($request->all(),[
        'phone_no' => 'required|min:10|max:10|exists:customers,phone',
        'bill_number' => 'required|unique:bill_orders|min:7|max:7',
        'draw' => 'numeric|required',
        'code' =>'required|json',
        ]);
         if($validator->fails()){
             return response()->json([
               'status' => false,
                'msg' => $validator->errors()
             ],422);
         }

        $customer = Customer::where('phone',$request->phone_no)->first();

        $type = "2d3d4d5d6d";
        $order = $this->billOrder($request->bill_number,$request->draw,$customer->id,$type);

       $arr = json_decode($request->code);
       foreach($arr as $code_money){
       $bill2d3d4d5d6d = new Billorder2d3d4d5d6d();
       $bill2d3d4d5d6d->number_code = $code_money->code;
       $bill2d3d4d5d6d->money = $code_money->money;
       $bill2d3d4d5d6d->order_id = $order->id;
       $bill2d3d4d5d6d->save();
       }
       $order->total = $order->billorder2d3d4d5d6ds->sum('money');
       $order->save();

        foreach ($order->billorder2d3d4d5d6ds as $bill6d){
            $list[] = $bill6d->number_code."=".($bill6d->money/1000)."k";
        }
        $body = collect($list)->implode(' // ');
        $title = "Lotto 6D";
        $this->PushNotificationController->pushNotification($body , $title, $customer->device_token);

       return response()->json([
           'status' => true,
           'data'   => $order
       ],201);

    }
    public function sell340(Request $request){
        $validator = Validator::make($request->all(),[
            'phone_no' => 'required|min:10|max:10|exists:customers,phone',
            'bill_number' => 'required|unique:bill_orders|min:7|max:7',
            'draw' => 'numeric|required',
            'code' =>'required|json',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'msg' => $validator->errors()
            ],422);
        }

        $customer = Customer::where('phone',$request->phone_no)->first();
        $type = "3/40";
        $order = $this->billOrder($request->bill_number,$request->draw,$customer->id,$type);

        $arr = json_decode($request->code);
        foreach($arr as $code_money){
            $bill340 = new Billorder340();

            $animal = explode(",", $code_money->code);
            $countAnimal = count($animal);
            if($countAnimal == 1){
                $bill340->animal1 = str_replace(" ", "",(string) $animal[0]);
            }
            if($countAnimal == 2){
                $bill340->animal1 = str_replace(" ", "",(string) $animal[0]);
                $bill340->animal2 = str_replace(" ", "",(string) $animal[1]);
            }
            if($countAnimal == 3){
                $bill340->animal1 = str_replace(" ", "",(string) $animal[0]);
                $bill340->animal2 = str_replace(" ", "",(string) $animal[1]);
                $bill340->animal3 = str_replace(" ", "",(string) $animal[2]);
            }


            $bill340->money = $code_money->money;
            $bill340->order_id = $order->id;
            $bill340->save();
        }

        $order->total = $order->bill340s->sum('money');
        $order->save();
        foreach ($arr as $bill340){
         $list[] = $bill340->code."=".($bill340->money/1000)."k";
        }
        $body = collect($list)->implode(' // ');
        $title = "Lotto 3/40";
        $this->PushNotificationController->pushNotification($body , $title, $customer->device_token);
        return response()->json([
            'status' => true,
            'data'   => $order
        ],201);

    }


    public function bill6dCustomer(){
        $bill2d3d4d5d6d = BillOrder::with(['billorder2d3d4d5d6ds','customers'])->orderBy('id','desc')->where('type','2d3d4d5d6d')->get();
        return response()->json($bill2d3d4d5d6d);
    }
    public function bil340Customer(){
        $bill340 = BillOrder::with(['bill340s','customers'])->orderBy('id','desc')->where('type','3/40')->get();
        return response()->json($bill340);
    }

    public function billAll(Request $request){

        $customerid = $request->user()->currentAccessToken();

//        if ($customerid->tokenable_type == "App\\Models\\Provider"){
//            return response()->json([
//                'status' => false,
//                'msg' => "This token is for provider"
//            ],422);
//        }

        $bills = BillOrder::where('customer_id',$customerid->tokenable->id)->get();

        return response()->json([
           'status' => true,
           'data' =>  $bills
        ]);
    }

    public function billDetail(Request $request){
        $validator = Validator::make($request->all(),[
            'bill' => 'required|exists:bill_orders,bill_number',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'msg' => $validator->errors()
            ],422);
        }

        $bills = BillOrder::where('bill_number',$request->bill)->first();

        if($bills->type == "3/40"){
            $win = $bills->winAmount340();
            $detail = $bills->bill340s;
        }else{
            $win = $bills->winAmount2d3d4d5d6d();
            $detail = $bills->billorder2d3d4d5d6ds;
        }


        return response()->json([
            'status' => true,
            'data' => $bills
        ]);
    }



}
