<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationApiController extends Controller
{
    public function notificationList(Request $request)
    {
        $customerId = $request->user()->currentAccessToken()->tokenable->id;
        $notification = Notification::with('typeNotifications')
            ->whereHas('notification_customer', function ($q) use ($customerId) {
            $q->where('customer_id', $customerId);
        })->paginate(10);
        return response()->json([
            'status' => true,
            'dataNotification' => $notification
        ]);
    }
}
