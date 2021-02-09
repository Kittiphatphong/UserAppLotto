<?php

namespace App\Http\Controllers;

use App\Models\RecommentImage;
use App\Models\RecommentLotto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RecommentLottoController extends Controller
{
    public function recommendList(){
        return view('recommend.recommendList')
            ->with('recommend_list','recommend_list');
    }
    public function recommendCreate(){
        return view('recommend.recommendCreate')
            ->with('recommend_create','recommend_create');
    }
    public function recommendStore(Request $request){
        $request->validate([
           'title' => 'required',
           'contentShow' => 'required',
            'images' => 'required'
        ]);
        $recomentLotto = new  RecommentLotto();
        $recomentLotto->title = $request->title;
        $recomentLotto->content = $request->contentShow;
        $recomentLotto->draw = $request->draw;
        $recomentLotto->save();
        if($files=$request->file('images')){
            foreach($files as $file){
                $recomentImage = new RecommentImage();
                $stringImageReformat = base64_encode('_'.time());
                $ext = $file->getClientOriginalName();
                $imageName = $stringImageReformat.".".$ext;
                $imageEncode = File::get($file);

                $recomentImage->recommend_id = $recomentLotto->id;
                $recomentImage->image = "/storage/recommend_image/".$imageName;
                $recomentImage->save();
                Storage::disk('local')->put('public/recommend_image/'.$imageName, $imageEncode);
            }

        }
    return back()->with('success','Upload success');

    }
}
