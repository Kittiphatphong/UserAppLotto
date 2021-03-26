<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer_Notification;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromotionApiController extends Controller
{
    public function promotionList(){
        return response()->json([
            'status' => true,
            'data' => Promotion::all()
        ]);
    }
    public function promotionFilter(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required|exists:promotions,id',
            'noti_id' => 'required|exists:customer__notifications,id'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => "false",
                'msg' => $validator->errors()->first()
            ],422);
        }
        $promotion =  Promotion::find($request->id);
        $customer_notification = Customer_Notification::find($request->noti_id);
        $customer_notification->read_status = 1;
        $customer_notification->save();

        return response()->json([
            'status' => true,
            'data' => $promotion
        ]);
    }

    public function promotionNotification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:promotions,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => "false",
                'msg' => $validator->errors()->first()
            ], 422);
        }
        $customerid = $request->user()->currentAccessToken();

    }

}
