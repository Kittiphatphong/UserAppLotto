<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    public function promotionList(){
        return view('promotion.promotionList')
            ->with('promotion_list','promotion_list');
    }

    public function promotionCreate(){
        return view('promotion.promotionCreate')
            ->with('promotion_create','promotion_create');
    }

    public function promotionStore(Request $request){
        if ($request->hasFile('photo')) {
            $image      = $request->file('photo');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(120, 120, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->stream(); // <-- Key point

            //dd();
            Storage::disk('local')->put('images/1/smalls'.'/'.$fileName, $img, 'public');
        }
    }

}
