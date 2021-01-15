<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class PromotionController extends Controller
{
    public function promotionList(){
        return view('promotion.promotionList')
            ->with('promotion_list',Promotion::orderBy('id','desc')->get());
    }

    public function promotionCreate(){
        return view('promotion.promotionCreate')
            ->with('promotion_create','promotion_create');
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
    $promotion->makePromotion($request->get('title'),$request->get('content'),$imageName,$start,$end);
    Storage::disk('local')->put('public/promotion_image/'.$imageName, $imageEncode);

    return back()->with('success','Uploaded promotion successful');
    }
}

