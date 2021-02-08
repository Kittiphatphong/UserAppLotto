<?php

namespace App\Http\Controllers;

use App\Models\Customer_Notification;
use App\Models\Type_Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
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
        $stringImageReformat = base64_encode('_'.time());
        $ext = $request->file('image')->getClientOriginalExtension();
        $imageName = $stringImageReformat.".".$ext;
        $imageEncode = File::get($request->image);

        $notification = new Type_Notification();

        $notification->icon = "/storage/notification_icon/".$imageName;
        $notification->name = $request->name;
        $notification->save();

        Storage::disk('local')->put('public/notification_icon/'.$imageName, $imageEncode);
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
        $notification->save();
        if($request->hasFile("image")){
            Storage::delete("public/notification_icon/".str_replace('/storage/notification_icon/','',$notification->icon));
            $request->image->storeAs("public/notification_icon",str_replace('/storage/notification_icon/','',$notification->icon));
        }
        return redirect()->route('notification.type')
            ->with('success','updated successful');
    }
}
