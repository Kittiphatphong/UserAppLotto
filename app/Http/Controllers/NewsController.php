<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsImage;
use App\Models\RecommentImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function upImages($files,$newsId){
        foreach($files as $file){
            $newImage = new NewsImage();
            $stringImageReformat = base64_encode('_'.time());
            $ext = $file->getClientOriginalName();
            $imageName = $stringImageReformat.".".$ext;
            $imageEncode = File::get($file);
            $newImage->news_id = $newsId;
            $newImage->image = "/storage/news_image/".$imageName;
            $newImage->save();
            Storage::disk('local')->put('public/news_image/'.$imageName, $imageEncode);
        }
    }

    public function index()
    {
        return view('news.newsList')
            ->with('news_list',News::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.newsCreate')
            ->with('news_create','new_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'contentShow' => 'required',
            'images' => 'required'
        ]);

        $news = new News();
        $news->title = $request->title;
        $news->content = $request->contentShow;
        $news->save();
        if($files=$request->file('images')){
            $this->upImages($files,$news->id);
        }
        return redirect()->route('news.index')->with('success','Upload success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('news.newsCreate')
            ->with('news_create','new_create')
            ->with('edit',News::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'contentShow' => 'required',
        ]);

        $news = News::find($id);
        $news->title = $request->title;
        $news->content = $request->contentShow;
        $news->save();

        if($files=$request->file('images')){
            foreach ($news->newsImages as $images){
                Storage::delete("public/news_image/".str_replace('/storage/news_image/','',$images->image));
               NewsImage::find($images->id)->delete();
            }

            $this->upImages($files,$news->id);
        }
    return redirect()->route('news.index')->with('success','Update successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        foreach ($news->newsImages as $images){
            Storage::delete("public/news_image/".str_replace('/storage/news_image/','',$images->image));
        }
        $news->delete();
        return back()->with('success','Delete successful');
    }
}
