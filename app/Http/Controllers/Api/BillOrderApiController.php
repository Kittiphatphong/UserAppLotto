<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BillOrder;
use App\Models\Billorder2d3d4d5d6d;
use App\Models\Billorder340;
use App\Models\Customer;
use Illuminate\Http\Request;

class BillOrderApiController extends Controller
{
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
        $request->validate([
        'phone_no' => 'required',
        'bill_number' => 'required|unique:bill_orders|min:7|max:7',
        'draw' => 'numeric|required',
        'code' =>'required|json',
        ]);

        $customer = Customer::where('phone',$request->phone_no)->first();
        if(!$customer){
            return response($customer->token()->count());
        }

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

       return response('buy lotto successful');

    }
    public function sell340(Request $request){
        $request->validate([
            'phone_no' => 'required',
            'bill_number' => 'required|unique:bill_orders|min:7|max:7',
            'draw' => 'numeric|required',
            'code' =>'required|json',

        ]);

        $customer = Customer::where('phone',$request->phone_no)->first();
        if(!$customer){
            return response('This phone number do not exist');
        }
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

        return response('buy lotto successful');

    }



}
