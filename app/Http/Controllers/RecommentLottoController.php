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
            ->with('recommend_list', RecommentLotto::orderBy('id','desc')->get());
    }
    public function recommendCreate(){
        return view('recommend.recommendCreate')
            ->with('recommend_create','recommend_create');
    }
    public function upImages($files,$recomendId){
        foreach($files as $file){
            $recomentImage = new RecommentImage();
            $stringImageReformat = base64_encode('_'.time());
            $ext = $file->getClientOriginalName();
            $imageName = $stringImageReformat.".".$ext;
            $imageEncode = File::get($file);

            $recomentImage->recommend_id = $recomendId;
            $recomentImage->image = "/storage/recommend_image/".$imageName;
            $recomentImage->save();
            Storage::disk('local')->put('public/recommend_image/'.$imageName, $imageEncode);
        }
    }
    public function recommendStore(Request $request){
        $request->validate([
           'title' => 'required',
           'contentShow' => 'required',
            'draw' => 'required|numeric',
            'images' => 'required'
        ]);
        $recomentLotto = new  RecommentLotto();
        $recomentLotto->makeRecommend($request->title,$request->contentShow,$request->draw);

        if($files=$request->file('images')){
        $this->upImages($files,$recomentLotto->id);
        }
    return redirect()->route('recommend.list')->with('success','Upload success');

    }

    public function recommendEdit($id){
        return view('recommend.recommendCreate')
            ->with('recommend_list','recommend_create')
            ->with('recommend',RecommentLotto::find($id));
    }

    public function recommendUpdate(Request $request,$id){
        $request->validate([
            'title' => 'required',
            'contentShow' => 'required',
            'draw' => 'required|numeric',
        ]);
        $recomentLotto = RecommentLotto::find($id);
        $recomentLotto->makeRecommend($request->title,$request->contentShow,$request->draw);


        if($files=$request->file('images')){
            foreach ($recomentLotto->recommendImages as $images){
                Storage::delete("public/recommend_image/".str_replace('/storage/recommend_image/','',$images->image));
                RecommentImage::find($images->id)->delete();
            }
            $this->upImages($files,$recomentLotto->id);
        }
        return redirect()->route('recommend.list')->with('success','Update success');
}
    public function recommendDelete($id){
        $recomentLotto = RecommentLotto::find($id);
        foreach ($recomentLotto->recommendImages as $images){
            Storage::delete("public/recommend_image/".str_replace('/storage/recommend_image/','',$images->image));
        }
        $recomentLotto->delete();
        return redirect()->route('recommend.list')->with('success','Delete success');
    }
}
