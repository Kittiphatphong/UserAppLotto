<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AirTimeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LottoController;
use App\Http\Controllers\SendMassageController;
use App\Models\BillOrder;
use App\Models\Billorder2d3d4d5d6d;
use App\Models\Billorder340;
use App\Models\Customer_Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\PushNotificationController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
class BillOrderApiController extends Controller
{
    protected $PushNotificationController;
    protected $AirTime;
    protected $Lotto;
    protected $sms;
    public function __construct(PushNotificationController $pushNotificationController,AirTimeController $airTimeController,LottoController $lottoController,SendMassageController $sendMassageController)
    {
        $this->PushNotificationController = $pushNotificationController;
        $this->AirTime = $airTimeController;
        $this->Lotto = $lottoController;
        $this->sms = $sendMassageController;
    }


    public function getDraw(){
        //Api form iPro get draw
        $getDraw = Http::post('http://104.155.206.54:1030/api_partner/web/index.php?r=other/get-all-draw',[
            'jwt_key' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjozOCwidXNlcm5hbWUiOiJVc2VyQXBwVGVzdCIsImlwYWRkciI6IiIsImp3dF9zdGFydCI6IjIwMjEtMDMtMTAgMTE6NTE6MDQiLCJqd3RfZXhwaXJlIjoiMjAyMS0wMy0xMCAxMTo1MTowNCJ9.ygSuXZDKBiL6GIKUquENUjEKHyWDu_vDeqBCp9j-FrI',
            'draw_type' => 1
        ]);
        return json_decode($getDraw,false)->data->draw_lotto[0]->draw_no ;

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
         $customer = $request->user()->currentAccessToken()->tokenable;
         $validator = Validator::make($request->all(),[
        'code' =>'required|json',
        ]);
         if($validator->fails()){
             return response()->json([
               'status' => false,
                'msg' => $validator->errors()->first()
             ],422);
         }
         //Create bill order
        $type = "2d3d4d5d6d";
        $order = $this->billOrder(null,$this->getDraw(),$customer->id,$type);
        $order->transaction_id= 'ncc'.$order->id;
        $order->save();

        //Create digit form bill order
        $arr = json_decode($request->code);
       foreach($arr as $code_money){
       $bill2d3d4d5d6d = new Billorder2d3d4d5d6d();
       $bill2d3d4d5d6d->digit = $code_money->code;
       $bill2d3d4d5d6d->money = $code_money->money;
       $bill2d3d4d5d6d->order_id = $order->id;
       $bill2d3d4d5d6d->save();
       }
       $order->total = $order->billorder2d3d4d5d6ds->sum('money');
       $order->save();

        //Api from iPro buy lotto
        $buyLotto = Http::post('http://104.155.206.54:1030/api_partner/web/index.php?r=lotto/sell',[
            'jwt_key' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjozOCwidXNlcm5hbWUiOiJVc2VyQXBwVGVzdCIsImlwYWRkciI6IiIsImp3dF9zdGFydCI6IjIwMjEtMDMtMTAgMTE6NTE6MDQiLCJqd3RfZXhwaXJlIjoiMjAyMS0wMy0xMCAxMTo1MTowNCJ9.ygSuXZDKBiL6GIKUquENUjEKHyWDu_vDeqBCp9j-FrI',
            'phone_number' => $customer->phone,
            'code' => $request->code,
            'transaction_id' => $order->transaction_id
        ]);

        //Check a quota
       $buyData = json_decode($buyLotto,false) ;
       if($buyData->status == false){
           foreach ($order->billorder2d3d4d5d6ds as $list){
               $bill2d3d4d5d6d = Billorder2d3d4d5d6d::find($list->id);
               $bill2d3d4d5d6d->money = 0;
               $bill2d3d4d5d6d->save();
           }
           $order->msg($buyData->description);
           return response()->json([
               'status' => false,
               'msg' => $buyData->description
           ],422);
       }elseif ($buyData->status == 2){
           foreach ($order->billorder2d3d4d5d6ds as $list){
               $bill2d3d4d5d6d = Billorder2d3d4d5d6d::find($list->id);
               $bill2d3d4d5d6d->money = 0;
               $bill2d3d4d5d6d->save();
           }
           $order->msg($buyData->description);
           return response()->json([
               'status' => false,
               'msg' => $buyData->description
           ],422);
       }
       else{
       if($order->total == $buyData->data->total_amount){
           $order->bill_number = $buyData->data->bill_number;
           $order->status_buy = true;
           $order->save();
           DB::table('billorder2d3d4d5d6ds')->where('order_id',$order->id)->update(['status_buy' => 1]);
       }else {
           $order->bill_number = $buyData->data->bill_number;
           $order->status_buy = true;
           $order->total = $buyData->data->total_amount;
           $order->save();
           foreach ($order->billorder2d3d4d5d6ds as $key => $bill) {
               $bill2d3d4d5d6d = Billorder2d3d4d5d6d::find($bill->id);
               if($bill2d3d4d5d6d->money==$buyData->data->data[$key]->money){
                   $bill2d3d4d5d6d->status_buy =1;
               }elseif ($bill2d3d4d5d6d->money!=$buyData->data->data[$key]->money && $buyData->data->data[$key]->money>0){
                   $bill2d3d4d5d6d->status_buy =2;
               }
               $bill2d3d4d5d6d->money = $buyData->data->data[$key]->money;
               $bill2d3d4d5d6d->save();
           }
       }

           $bill = Billorder2d3d4d5d6d::where('order_id',$order->id)->select('digit','money')->get();
           $orderBill = BillOrder::find($order->id);

           //Send notification
           foreach ($bill as $bill6d){
               $list[] = $bill6d->digit."=".number_format($bill6d->money)."LAK";
           }
           $body = collect($list)->implode(' ');
           $title = "Buy lotto 6D";
           $this->PushNotificationController->pushNotificationBuy($body , $title,1, $customer->id,$order);


           return response()->json([
               'status' => true,
               'data'   => $bill,
               'bill_number' => $orderBill->bill_number,
               'total_amount' => $orderBill->total,
               'draw' => $orderBill->draw
           ],201);
       }




    }
    public function sell340(Request $request){
        $customer = $request->user()->currentAccessToken()->tokenable;
        $validator = Validator::make($request->all(),[
            'code' =>'required|json',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'msg' => $validator->errors()->first()
            ],422);
        }


        $type = "3/40";
        $order = $this->billOrder(null,$this->getDraw(),$customer->id,$type);
        $order->transaction_id= 'ncc'.$order->id;
        $order->save();

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
            $bill340->digit = $code_money->code;
            $bill340->money = $code_money->money;
            $bill340->order_id = $order->id;
            $bill340->save();
        }
        $order->total = $order->bill340s->sum('money');
        $order->save();

        //Api from iPro buy lotto
        $buyLotto = Http::post('http://104.155.206.54:1030/api_partner/web/index.php?r=lotto-340/sell',[
            'jwt_key' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjozOCwidXNlcm5hbWUiOiJVc2VyQXBwVGVzdCIsImlwYWRkciI6IiIsImp3dF9zdGFydCI6IjIwMjEtMDMtMTAgMTE6NTE6MDQiLCJqd3RfZXhwaXJlIjoiMjAyMS0wMy0xMCAxMTo1MTowNCJ9.ygSuXZDKBiL6GIKUquENUjEKHyWDu_vDeqBCp9j-FrI',
            'phone_number' => $customer->phone,
            'code' => $request->code,
            'transaction_id' => $order->transaction_id
        ]);
        //Check a quota
        $buyData = json_decode($buyLotto,false) ;
        if($buyData->status == false){
            foreach ($order->bill340s as $list){
                $bill340= Billorder340::find($list->id);
                $bill340->money = 0;
                $bill340->save();
            }
            $order->msg($buyData->description);
            return response()->json([
                'status' => false,
                'msg' => $buyData->description
            ],422);
        }elseif ($buyData->status == 2){
            foreach ($order->bill340s as $list){
                $bill340= Billorder340::find($list->id);
                $bill340->money = 0;
                $bill340->save();
            }
            $order->msg($buyData->description);
            return response()->json([
                'status' => false,
                'msg' => $buyData->description
            ],422);
        }
        else{
            if($order->total == $buyData->data->total_amount){
                $order->bill_number = $buyData->data->bill_number;
                $order->status_buy = true;
                $order->save();
                DB::table('billorder340s')->where('order_id',$order->id)->update(['status_buy' => 1]);
            }else {

                $order->bill_number = $buyData->data->bill_number;
                $order->status_buy = true;
                $order->total = $buyData->data->total_amount;
                $order->save();



                foreach ($order->bill340s as $key => $bill) {
                    $bill340 = Billorder340::find($bill->id);
                    if($bill340->money==$buyData->data->data[$key]->money){
                        $bill340->status_buy =1;
                    }elseif ($bill340->money!=$buyData->data->data[$key]->money && $buyData->data->data[$key]->money>0){
                        $bill340->status_buy =2;
                    }
                    $bill340->money = $buyData->data->data[$key]->money;
                    $bill340->save();
                }
            }

            $bill = Billorder340::where('order_id',$order->id)->select('digit','money')->get();
            $orderBill = BillOrder::find($order->id);

            //Send notification
            foreach ($bill as $bill340){
                $list[] = $bill340->digit."=".number_format($bill340->money)."Lak";
            }
            $body = collect($list)->implode(' ');
            $title = "Buy lotto 3/40";
            $this->PushNotificationController->pushNotificationBuy($body , $title,1, $customer->id,$order);
            return response()->json([
                'status' => true,
                'data'   => $bill,
                'bill_number' => $orderBill->bill_number,
                'total_amount' => $orderBill->total,
                'draw' => $orderBill->draw
            ],201);


        }




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

        $bills = BillOrder::orderBy('id','desc')->where('customer_id',$customerid->tokenable->id)->where('status_buy',true)->get();

        return response()->json([
           'status' => true,
           'data' =>  $bills
        ]);
    }
    public function billAllWin(Request $request){

        $customerid = $request->user()->currentAccessToken();

        $bills = BillOrder::orderBy('id','desc')->where('customer_id',$customerid->tokenable->id)->where('status_win',true)->where('status_buy',true)->get();

        return response()->json([
            'status' => true,
            'data' =>  $bills
        ]);
    }

    public function billDetail(Request $request){


        if($request->noti_id == null){
            $validator = Validator::make($request->all(),[
                'id' => 'required|exists:bill_orders,id',
            ]);
        }else{
            $validator = Validator::make($request->all(),[
                'id' => 'required|exists:bill_orders,id',
                'noti_id' => 'exists:customer__notifications,id'
            ]);
            $customer_notification = Customer_Notification::find($request->noti_id);
            $customer_notification->read_status = 1;
            $customer_notification->save();
        }

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'msg' => $validator->errors()->first()
            ],422);
        }

        $bills = BillOrder::find($request->id);


        if($bills->type == "3/40"){


            $win = $bills->winAmount340();
            $detail = $bills->billSelect340s;
        }else{
            $win = $bills->winAmount2d3d4d5d6d();
            $detail = $bills->billorder2d3d4d5d6ds;
        }
        $data = BillOrder::find($bills->id);

        return response()->json([
            'status' => true,
            'data' => ['bill'=>$data,'digits' => $detail]

        ]);
    }



}
