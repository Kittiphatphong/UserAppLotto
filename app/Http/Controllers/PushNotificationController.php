<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillOrder;
use App\Models\Customer;
use App\Models\Customer_Notification;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PushNotificationController extends Controller
{
    public function getDraw(){
        //Api form iPro get draw
        $getDraw = Http::post('http://104.155.206.54:1030/api_partner/web/index.php?r=other/get-all-draw',[
            'jwt_key' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjozOCwidXNlcm5hbWUiOiJVc2VyQXBwVGVzdCIsImlwYWRkciI6IiIsImp3dF9zdGFydCI6IjIwMjEtMDMtMTAgMTE6NTE6MDQiLCJqd3RfZXhwaXJlIjoiMjAyMS0wMy0xMCAxMTo1MTowNCJ9.ygSuXZDKBiL6GIKUquENUjEKHyWDu_vDeqBCp9j-FrI',
            'draw_type' => 1
        ]);
        return json_decode($getDraw,false)->data->draw_lotto[0]->draw_no ;

    }

    protected $serverKey = 'AAAAj--EuJs:APA91bGwks5UxG8TkSIf3kCeeOzKhZS8PSFy_DtQjVzSG5-zUvV6fbMPQ9-TPKyEyGeHVpaiK4-zZ0h2kScrr-TS0RwrGG79EQaSkGedR4Kxkg5BhlbI7Fi_zJOThvLphJYkn_J0UFAi';

    public function pushNotification($body ,$title,$token){
        $token = "f8NAhkmxsqLDcBkj1Up3pR:APA91bGOOWO22D4Z8G21VsZu-RyRq_dklGz7yXkfzO2HCAJWD2u4rN6KfFrr4WfKzPOCb06GLrpKAwd0-mjXB-jmgpLheIyVkHZhFpeET-KNHvUYKWMZG6qbfIz9-_8hM4RYzRyMJADr";
        $from = "AAAA1twLRCc:APA91bF77GPgkgQsjvS2QNAhVVG1ycM2kPRgV9NGNApRNf_P5ylcuF2RwudjWqwvjG9Fn5E3Jfc31z5IYeTo8331lAJcEpjciMLSrbiDTACKFZzWeDEhITh7il6sam_hlTwRoFhipN9I";
        $msg = array
        (
            'body'  => $body,
            'title' => $title,
            'receiver' => 'erw',
            'icon'  => "https://scontent.fbkk15-1.fna.fbcdn.net/v/t1.0-9/140317948_270623577819917_1398799135777551851_n.jpg?_nc_cat=110&ccb=2&_nc_sid=09cbfe&_nc_eui2=AeEArrcihmDjHAOQqXdqIFLum30_-gmGOAebfT_6CYY4B45A8d-fL5YveW5EKf2q7QO_KapKptj8u6tV45BbaQOJ&_nc_ohc=wMo_ORi8zL4AX9gS94q&_nc_ht=scontent.fbkk15-1.fna&oh=4502219f6a1ec618ca8288fc1a2424e1&oe=602DC018",/*Default Icon*/
            'sound' => 'mySound'/*Default sound*/
        );

        $fields = array
        (
            'to'        => $token,
            'notification'  => $msg
        );

        $headers = array
        (
            'Authorization: key=' . $from,
            'Content-Type: application/json'
        );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
    }


    public function sendPush($body ,$title, $massages)
    {

        try {


            $notification = [
                "condition" => "'Events' in topics", //multi topics : "'TopicA' in topics && ('TopicB' in topics || 'TopicC' in topics)";
                "data"=>["message"=> $massages],
                "notification" =>
                    [
                        "title" => $title,
                        "body" => $body,
                    ],

            ];

            $dataString = json_encode($notification, JSON_THROW_ON_ERROR);
            $headers = [
                'Authorization: key=' . $this->serverKey,
                'Content-Type: application/json',
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
            curl_exec($ch);
            return response()->json(['message', 'Notification sent!']);
        } catch (Throwable $e) {
            return response($e);
        }

    }
    public function sendPushDevice($body ,$title, $token,$massages)
    {

        try {


            $notification = [
                "registration_ids" => [$token],
                "data"=>["message"=> $massages],
                "notification" =>
                    [
                        "title" => $title,
                        "body" => $body,
                    ],

            ];

            $dataString = json_encode($notification, JSON_THROW_ON_ERROR);
            $headers = [
                'Authorization: key=' . $this->serverKey,
                'Content-Type: application/json',
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
            curl_exec($ch);
            return response()->json(['message', 'Notification sent!']);
        } catch (Throwable $e) {
            return response($e);
        }

    }

    public function pushNotificationBuy($body ,$title,$type,$idCustomer,$massages){
        $customer = Customer::find($idCustomer);
        if($customer->device_token != null){
            $notification = new Notification();
            $notification->newNotification($title,$body,$type,$massages);
            $customer_notification = new Customer_Notification();
            $this->sendPushDevice($body,$title,$customer->device_token,$massages);
            $customer_notification->newCustomerNotification($customer->id,$notification->id);
        }

    }

    public function pushNotificationAll($body ,$title,$type,$massages){
        $customers = Customer::whereNotNull('device_token')->get();
        $notification = new Notification();
        $notification->newNotification($title,$body,$type,$massages);
        foreach($customers as $customer){
            $customer_notification = new Customer_Notification();
            $customer_notification->newCustomerNotification($customer->id,$notification->id);
        }
        $this->sendPush($body,$title,$massages);
    }

    public function pushNotificationWin($draw){

        $bills = BillOrder::where('status_win',1)->where('status_buy',true)->where('total_win','>',0)->where('draw',$draw)->get();

        foreach ($bills as $bill){
            $title= "Congratulations You win";
            $body= "Type: ".$bill->type." || Total: ".number_format($bill->total_win);

            $notification = new Notification();
            $notification->newNotification($title,$body,2,$bill);
            $customer_notification = new Customer_Notification();
            $this->sendPushDevice($body,$title,$bill->customers->device_token,$bill);
            $customer_notification->newCustomerNotification($bill->customers->id,$notification->id);

        }

//            $this->pushNotification($body,$title,$customer->device_token);
    }



























//    public function pushNotificationWin($draw){
//        $customer6ds = Customer::whereNotNull('device_token')
//            ->whereHas('orders',function ($q) use($draw){
//                $q->where('status_win',1);
//                $q->where('draw',$draw);
//                $q->where('type',"2d3d4d5d6d");
//            })->get();
//        $customer340s = Customer::whereNotNull('device_token')
//            ->whereHas('orders',function ($q) use($draw){
//                $q->where('status_win',1);
//                $q->where('draw',$draw);
//                $q->where('type',"3/40");
//            })->get();
//
//        $title6d= "Congratulations You win";
//        $body6d=null;
//
//
//        foreach($customer6ds as $customer){
//            $orders = $customer->orders->where('status_win',1)->where('draw',$draw)->where('type','2d3d4d5d6d');
//            foreach ($orders as $order){
//
//                $orderText= "Draw=".$draw." total win=".number_format($order->winAmount2d3d4d5d6d())."LAK";
//                $win6dTexts=null;
//                foreach ($order->win2d3d4d5d6ds as $win6d){
//                    $win6dText = $win6d->number_code;
//                    $sumWin = $win6d->sumWins();
//                    $win6dTexts.=" ".$win6dText."=".$sumWin.";";
//                }
//                $body6d=$orderText." Code:".$win6dTexts;
//                $notification = new Notification();
//                $notification->newNotification($title6d,$body6d,2,$order);
//                $customer_notification = new Customer_Notification();
//                $this->sendPush($body6d,$title6d,$customer->device_token);
//                $customer_notification->newCustomerNotification($customer->id,$notification->id);
////              $body6d.=$orderText."\nCode:".$win6dTexts."\n";
//            }
//
////                $notification = new Notification();
////                $notification->newNotification($title6d,$body6d,2);
////                $customer_notification = new Customer_Notification();
////                $this->sendPush($body6d,$title6d,$customer->device_token);
////                $customer_notification->newCustomerNotification($customer->id,$notification->id);
//
//        }
//
//        $title340= "Congratulations You win";
//        $body340=null;
//
//        foreach($customer340s as $customer){
//            $orders = $customer->orders->where('status_win',1)->where('draw',$draw)->where('type','3/40');
//            foreach ($orders as $order){
//
//                $orderText= "Draw=".$draw." total win=".number_format($order->winAmount340())."LAK";
//                $win340Texts=null;
//
//                foreach ($order->win340s as $win340){
//
//                    if($win340->animal1 != null && $win340->animal2 == null && $win340->animal3 == null)
//                        $win340Text = "[".$win340->animal1."]";
//                    elseif($win340->animal1 != null && $win340->animal2 != null && $win340->animal3 == null)
//                        $win340Text = "[".$win340->animal1.",".$win340->animal2."]";
//                    else
//                        $win340Text = "[".$win340->animal1.",".$win340->animal2.",".$win340->animal3."]";
//
//                    $sumWin = $win340->sumWins();
//                    $win340Texts.=" ".$win340Text."=".$sumWin.";";
//                }
//                $body340 = $orderText." Code:".$win340Texts;
//                $notification = new Notification();
//                $notification->newNotification($title340,$body340,2,$order);
//                $customer_notification = new Customer_Notification();
//                $this->sendPush($body340,$title340,$customer->device_token);
//                $customer_notification->newCustomerNotification($customer->id,$notification->id);
//
////                $body340.=$orderText."\nCode:".$win340Texts."\n";
//
//            }
//
////                $notification = new Notification();
////                $notification->newNotification($title340,$body340,2);
////                $customer_notification = new Customer_Notification();
////                $this->sendPush($body340,$title340,$customer->device_token);
////                $customer_notification->newCustomerNotification($customer->id,$notification->id);
//        }
////            $this->pushNotification($body340,$title340,$customer->device_token);
//    }
}
