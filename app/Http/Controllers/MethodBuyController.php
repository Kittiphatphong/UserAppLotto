<?php

namespace App\Http\Controllers;

use App\Models\LiveLink;
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
        return view('methodBuy.methodBuyList')
            ->with('method_buy_list',MethodBuy::latest()->get());
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

//        DB::table('method_buys')->where('status',1)->update(['status' => 0]);

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
    public function show($id)
    {
        $methodBuy = MethodBuy::find($id);
        if($methodBuy->status == 1){
            $methodBuy->status = 0 ;

        }else{
//            DB::table('method_buys')->where('status',1)->update(['status' => 0]);
            $methodBuy->status = 1 ;
        }
        $methodBuy->save();
        return back()->with('success','update status success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MethodBuy  $methodBuy
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('methodBuy.methodBuyCreate')
            ->with('method_buy_create','method_buy_create')
            ->with('edit',MethodBuy::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MethodBuy  $methodBuy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'description' => 'required',

        ]);

//        DB::table('method_buys')->where('status',1)->update(['status' => 0]);

        $methodBuy = MethodBuy::find($id);
        $methodBuy->title = $request->title;
        $methodBuy->link = $request->link;
        $methodBuy->description = $request->description;
        $methodBuy->status = 1 ;
        $methodBuy->save();

        if($files=$request->file('images')){

            foreach ($methodBuy->methodBuyImages as $images){
                Storage::delete("public/method_buy_image/".str_replace('/storage/method_buy_image/','',$images->image));
                MethodBuyImage::find($images->id)->delete();
            }
            $this->upImages($files,$methodBuy->id);
        }
        return redirect()->route('method-buy.index')->with('success','Update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MethodBuy  $methodBuy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $methodBuy = MethodBuy::find($id);
        foreach ($methodBuy->methodBuyImages as $images){
            Storage::delete("public/method_buy_image/".str_replace('/storage/method_buy_image/','',$images->image));
        }
        $methodBuy->delete();
        return back()->with('success','Delete successful');
    }
}
