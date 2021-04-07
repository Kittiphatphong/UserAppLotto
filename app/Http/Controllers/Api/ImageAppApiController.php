<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ImageApp;
use Illuminate\Http\Request;

class ImageAppApiController extends Controller
{
    public function imageApp(){
        try {
           $imageApp = ImageApp::where('active',true)->get();
           $image=null;
           if($imageApp->count()>0){
               $image= $imageApp->first()->image;
           }
            return response()->json(['status' => true , 'image' => $image]);
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => $e->getMessage()
            ],422);
        }
    }
}
