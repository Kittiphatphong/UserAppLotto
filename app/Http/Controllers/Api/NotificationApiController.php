<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer_Notification;
use App\Models\Notification;
use http\Message\Body;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationApiController extends Controller
{

    public function notification($customerId,$type_id){
        return Notification::with(['typeNotifications','notification_customers'=> function($q) use ($customerId){
            $q->where('customer_id', $customerId);
        }])->orderBy('id','desc')
            ->whereHas('notification_customers', function ($q) use ($customerId) {
                $q->where('customer_id', $customerId);
            })->where('type_id',$type_id)->select('id','title','body','massages','type_id')->get();
    }

    public function notificationList(Request $request)
    {
        $customerId = $request->user()->currentAccessToken()->tokenable->id;
        $notification = Notification::with(['typeNotifications','notification_customers'=> function($q) use ($customerId){
            $q->where('customer_id', $customerId);
        }])->orderBy('id','desc')
            ->whereHas('notification_customers', function ($q) use ($customerId) {
                $q->where('customer_id', $customerId);
            })->select('id','title','body','massages','type_id')->get();

        return response()->json([
            'status' => true,
            'data' => $notification
        ]);
    }

    public function notificationBuying(Request $request){
        $customerId = $request->user()->currentAccessToken()->tokenable->id;
        return response()->json([
            'status' => true,
            'data' => $this->notification($customerId,1)
        ]);
    }
    public function notificationWining(Request $request){
        $customerId = $request->user()->currentAccessToken()->tokenable->id;
        return response()->json([
            'status' => true,
            'data' => $this->notification($customerId,2)
        ]);
    }
    public function notificationResult(Request $request){
        $customerId = $request->user()->currentAccessToken()->tokenable->id;
        return response()->json([
            'status' => true,
            'data' => $this->notification($customerId,3)
        ]);
    }
    public function notificationPromotion(Request $request){
        $customerId = $request->user()->currentAccessToken()->tokenable->id;
        return response()->json([
            'status' => true,
            'data' => $this->notification($customerId,4)
        ]);
    }
    public function notificationNews(Request $request){
        $customerId = $request->user()->currentAccessToken()->tokenable->id;
        return response()->json([
            'status' => true,
            'data' => $this->notification($customerId,5)
        ]);
    }
}
