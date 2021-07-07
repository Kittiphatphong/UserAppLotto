<?php

namespace App\Http\Controllers;

use App\Models\Customer_Notification;
use App\Models\Type_Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Trail\UploadImage;
class NotificationController extends Controller
{
    use UploadImage;
    public function notificationList(){
        return view('notification.notificationList')
            ->with('notification_list',Customer_Notification::orderBy('id','desc')->get());
    }
    public function notificationType(){
        return view('notification.notificationType')
            ->with('notification_icon',Type_Notification::all());
    }
    public function notificationIcon(){
        return view('notification.notificationIcon')
            ->with('notification_icon','notification_icon');
    }
    public function notificationStore(Request $request){
        $request->validate([
            'name' => 'required',
            'image' => 'required|file|image|max:50000|mimes:jpeg,png,jpg',
        ]);


        $notification = new Type_Notification();

        $notification->icon = $this->upload($request,"notification_icon");
        $notification->name = $request->name;
        $notification->save();


        return redirect()->route('notification.type')
            ->with('success','success');
    }

    public function notificationIconEdit($id){
        return view('notification.notificationIcon')
            ->with('notification_icon','notification_icon')
            ->with('notification_info',Type_Notification::find($id));
    }

    public function notificationUpdate(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'image' => 'file|image|max:50000|mimes:jpeg,png,jpg',
        ]);
        $notification = Type_Notification::find($id);
        $notification->name = $request->name;

        if($request->hasFile("image")){
            Storage::delete("public/notification_icon/".str_replace('/storage/notification_icon/','',$notification->icon));
            $notification->icon = $this->upload($request,"notification_icon");
        }
        $notification->save();
        return redirect()->route('notification.type')
            ->with('success','updated successful');
    }
}
