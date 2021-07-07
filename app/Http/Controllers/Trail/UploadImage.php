<?php

namespace App\Http\Controllers\Trail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait UploadImage
{
    public function upload($request,$folder){
        $stringImageReformat = base64_encode('_'.time());
        $ext = $request->file('image')->getClientOriginalExtension();
        $imageName = $stringImageReformat.".".$ext;
        $imageEncode = File::get($request->image);
        Storage::disk('local')->put('public/'.$folder.'/'.$imageName, $imageEncode);
        return "/storage/".$folder."/".$imageName;
    }
}
