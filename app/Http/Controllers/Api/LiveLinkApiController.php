<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LiveLink;
use Illuminate\Http\Request;

class LiveLinkApiController extends Controller
{
    public function liveLink(){
        try {
            $link = LiveLink::where('status',1)->pluck('link')->first();
         return response()->json([
            'status' => true,
             'link' => $link
         ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => $e->getMessage()
            ],422);
         }
    }
}
