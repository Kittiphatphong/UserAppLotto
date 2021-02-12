<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;
use App\Models\Result;
use Illuminate\Http\Request;

class BuyLottoController extends Controller
{
    protected $PushNotificationController;
    public function __construct(PushNotificationController $pushNotificationController)
    {
        $this->PushNotificationController = $pushNotificationController;
    }

    protected function drawBuy(){
        return Result::whereRaw('id = (select max(`id`) from results)')->pluck('draw')->first()+1;
}
    public function buy(){
        return view('buyLotto.buy')
            ->with('buy','buy')
            ->with('draw', $this->drawBuy());
    }
   public function store6d(Request $request){
       $request->validate([
           'digit' => 'required|min:2|max:6',
           'money' => 'required',
           'phone_no' => 'required|min:10|max:10|exists:customers,phone',
       ]);
       $customer = Customer::where('phone',$request->phone_no)->first();

       $type = "2d3d4d5d6d";
       $bill = new Bill();
       $unique_bill = false;
       while (!$unique_bill) {
           $bill_number = rand(10000000,99999999);
           if (Bill::all()->where('bill_number',$bill_number)->count()<=0) {
               $unique_bill = true;
           }
       }
       $pieces = explode(",", $request->digit);
       $bill->newBill($customer->id,$bill_number,$this->drawBuy(),$type,
           round(str_replace(',','',$request->money)),$pieces);

       $body = str_replace('"','',implode(',',$bill->digit)) ." = ". number_format($bill->money). "Lak";
       $title = "Buy lotto 6D";
       $this->PushNotificationController->pushNotificationBuy($body , $title,1, $customer->id,$bill);
       return back()->with('success','Buy success');

   }
   public function store40(Request $request){
       $request->validate([
           'animal1' => 'required|different:animal2|min:2|max:2',
           'animal2' => 'different:animal3|min:2|max:2',
           'animal3' => 'different:animal1|min:2|max:2',
           'money' => 'required',
           'phone_no' => 'required|min:10|max:10|exists:customers,phone',
       ]);
       if(round($request->animal1)>40 || round($request->animal2)>40 || round($request->animal3)>40){
           return back()->with("warning","3/40 not more than 40");
       }

       $customer = Customer::where('phone',$request->phone_no)->first();
       $type = "3/40";
       $bill = new Bill();
       $unique_bill = false;
       while (!$unique_bill) {
           $bill_number = rand(10000000,99999999);
           if (Bill::all()->where('bill_number',$bill_number)->count()<=0) {
               $unique_bill = true;
           }
       }
       $animal = [];
       if($request->animal1 != null && $request->animal2 == null && $request->animal3 == null){
        array_push($animal,$request->animal1);
       } elseif($request->animal1 != null && $request->animal2 != null && $request->animal3 == null){
           array_push($animal,$request->animal1,$request->animal2);
       }elseif($request->animal1 != null && $request->animal2 != null && $request->animal3 != null){
           array_push($animal,$request->animal1,$request->animal2,$request->animal3);
       }else{
           return back()->with("warning","please 1/40 first and consecutive order");
       }
       $bill->newBill($customer->id,$bill_number,$this->drawBuy(),$type,round(str_replace(',','',$request->money)),$animal);

       $body = str_replace('"','',implode(',',$bill->digit)) ." = ". number_format($bill->money). "Lak";
       $title = "Buy lotto 3/40";
       $this->PushNotificationController->pushNotificationBuy($body , $title,1, $customer->id,$bill);
       return back()->with('success','Buy success');

   }
}
