<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    public function pushNotification($body ,$title,$token){

//        $token = "ezawAWrbaUNt3yJ_xUA7cg:APA91bEyIsZuq2-UB6P70PvLSJK5pKn6EA51o01E_KfLgMabw3LM2hpiIJzru9ioZ3nFNpqtcTagv8HclUQgboaZnPc7IjObWzSUJ7rlzRh6DivOE_R6sbG8Nn3Tl4WeK9CS7HusYVN5";
//        $token = "f8NAhkmxsqLDcBkj1Up3pR:APA91bGOOWO22D4Z8G21VsZu-RyRq_dklGz7yXkfzO2HCAJWD2u4rN6KfFrr4WfKzPOCb06GLrpKAwd0-mjXB-jmgpLheIyVkHZhFpeET-KNHvUYKWMZG6qbfIz9-_8hM4RYzRyMJADr";
//
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

    public function pushNotificationAll($body ,$title){
        $customers = Customer::whereNotNull('device_token')->get();
        foreach($customers as $customer){
            $this->pushNotification($body,$title,$customer->device_token);
        }

    }
}
