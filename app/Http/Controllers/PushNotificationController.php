<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    public function pushNotification($body ,$title){

//        $token = "ezawAWrbaUNt3yJ_xUA7cg:APA91bEyIsZuq2-UB6P70PvLSJK5pKn6EA51o01E_KfLgMabw3LM2hpiIJzru9ioZ3nFNpqtcTagv8HclUQgboaZnPc7IjObWzSUJ7rlzRh6DivOE_R6sbG8Nn3Tl4WeK9CS7HusYVN5";
        $token = "f8NAhkmxsqLDcBkj1Up3pR:APA91bGOOWO22D4Z8G21VsZu-RyRq_dklGz7yXkfzO2HCAJWD2u4rN6KfFrr4WfKzPOCb06GLrpKAwd0-mjXB-jmgpLheIyVkHZhFpeET-KNHvUYKWMZG6qbfIz9-_8hM4RYzRyMJADr";
        $from = "AAAA1twLRCc:APA91bF77GPgkgQsjvS2QNAhVVG1ycM2kPRgV9NGNApRNf_P5ylcuF2RwudjWqwvjG9Fn5E3Jfc31z5IYeTo8331lAJcEpjciMLSrbiDTACKFZzWeDEhITh7il6sam_hlTwRoFhipN9I";
        $msg = array
        (
            'body'  => $body,
            'title' => $title,
            'receiver' => 'erw',
            'icon'  => "data:image/png;base64,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",/*Default Icon*/
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
}
