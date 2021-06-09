<?php

namespace App\Http\Controllers;

use App\Models\MethodBuy;
use App\Models\MethodBuyImage;
use App\Models\RecommentImage;
use App\Models\RecommentLotto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MethodBuyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upImages($files,$methodBuyId){
        foreach($files as $file){
            $methodBuyImage = new MethodBuyImage();
            $stringImageReformat = base64_encode('_'.time());
            $ext = $file->getClientOriginalName();
            $imageName = $stringImageReformat.".".$ext;
            $imageEncode = File::get($file);

            $methodBuyImage->method_buy_id = $methodBuyId;
            $methodBuyImage->image = "/storage/method_buy_image/".$imageName;
            $methodBuyImage->save();
            Storage::disk('local')->put('public/method_buy_image/'.$imageName, $imageEncode);
        }
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('methodBuy.methodBuyCreate')
            ->with('method_buy_create','method_buy_create');
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
            'link' => 'required',
            'description' => 'required',
            'images' => 'required'
        ]);

        DB::table('method_buys')->where('status',1)->update(['status' => 0]);

        $methodBuy = new  MethodBuy();
        $methodBuy->title = $request->title;
        $methodBuy->link = $request->link;
        $methodBuy->description = $request->description;
        $methodBuy->status = 1 ;
        $methodBuy->save();

        if($files=$request->file('images')){
            $this->upImages($files,$methodBuy->id);
        }
        return redirect()->route('method-buy.index')->with('success','Upload success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MethodBuy  $methodBuy
     * @return \Illuminate\Http\Response
     */
    public function show(MethodBuy $methodBuy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MethodBuy  $methodBuy
     * @return \Illuminate\Http\Response
     */
    public function edit(MethodBuy $methodBuy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MethodBuy  $methodBuy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MethodBuy $methodBuy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MethodBuy  $methodBuy
     * @return \Illuminate\Http\Response
     */
    public function destroy(MethodBuy $methodBuy)
    {
        //
    }
}
