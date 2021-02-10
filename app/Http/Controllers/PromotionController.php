<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\PushNotificationController;

class PromotionController extends Controller
{
    protected $PushNotificationController;

    public function __construct(PushNotificationController $pushNotificationController)
    {
        $this->PushNotificationController = $pushNotificationController;
    }

    public function promotionList(){
        return view('promotion.promotionList')
            ->with('promotion_list',Promotion::orderBy('id','desc')->get());
    }

    public function promotionCreate(){
        $promotion = New Promotion();

        return view('promotion.promotionCreate')
            ->with('promotion_create','promotion_create')
            ->with('promotion',$promotion);
    }

    public function promotionStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'start' => 'required',
            'end' => 'required',
            'image' => 'required|file|image|max:50000|mimes:jpeg,png,jpg'
        ]);
    $stringImageReformat = base64_encode('_'.time());
    $ext = $request->file('image')->getClientOriginalExtension();
    $imageName = $stringImageReformat.".".$ext;
    $imageEncode = File::get($request->image);

    $promotion = new Promotion();
    $start = Carbon::parse($request->get('start'))->toDateTimeString();
    $end = Carbon::parse($request->get('end'))->toDateTimeString();
    $promotion->makePromotion($request->get('title'),$request->get('content'),"/storage/promotion_image/".$imageName,$start,$end);
    Storage::disk('local')->put('public/promotion_image/'.$imageName, $imageEncode);

    return redirect()->route('promotion.list')->with('success','Uploaded promotion successful');
    }

    public function promotionEdit($id){
        $promotion = Promotion::find($id);

        return view('promotion.promotionCreate')
            ->with('promotion_create','promotion_create')
            ->with('promotion',$promotion)
            ->with('edit','edit');
    }

    public function promotionUpdate(Request $request,$id){
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'content' => 'required',
            'start' => 'required',
            'image' => 'file|image|max:50000|mimes:jpeg,png,jpg'
        ]);
        $promotion = Promotion::find($id);
        $start = Carbon::parse($request->get('start'))->toDateTimeString();
        $end = Carbon::parse($request->get('end'))->toDateTimeString();
        $promotion->makePromotion($request->get('title'),$request->get('content'),null,$start,$end);
        if($request->hasFile("image")){
            Storage::delete("public/promotion_image/".str_replace('/storage/promotion_image/','',$promotion->image));
            $request->image->storeAs("public/promotion_image",str_replace('/storage/promotion_image/','',$promotion->image));
        }
        return redirect()->route('promotion.list')->with('success','Edited promotion successful');
    }

    public function promotionDelete($id){
        $promotion = Promotion::find($id);
        Storage::delete("public/promotion_image/".str_replace('/storage/promotion_image/','',$promotion->image));
        $promotion->delete();
        return redirect()->route('promotion.list')->with('success','Deleted promotion successful');

    }

    public function promotionNotification($id){

        $promotion = Promotion::find($id);
            $this->PushNotificationController->pushNotificationAll($promotion->content,"Promotion",4,$promotion);
        return back()->with('success',"push notification successful");


    }
}

