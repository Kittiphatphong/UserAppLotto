<?php

namespace App\Http\Controllers;

use App\Models\MethodBuyCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Trail\UploadImage;

class MethodBuyCategoryController extends Controller
{
    use UploadImage;
    public function index()
    {
        return view ('methodBuyCategory.methodBuyCategoryList')
            ->with('method_buy_categories',MethodBuyCategory::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('methodBuyCategory.methodBuyCategoryCreate')
            ->with('method_buy_categories','method_buy_categories');
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
           'name' => 'required',
            'image' => 'required|file|image|max:50000|mimes:jpeg,png,jpg',
        ]);
        $method_buy_category = new MethodBuyCategory();
        $method_buy_category->name = $request->name;
        $method_buy_category->image = $this->upload($request,'method_buy_category_image');
        $method_buy_category->save();

        return redirect()->route('method-buy-category.index')
            ->with('success','Create category successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MethodBuyCategory  $methodBuyCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MethodBuyCategory $methodBuyCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MethodBuyCategory  $methodBuyCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view ('methodBuyCategory.methodBuyCategoryCreate')
            ->with('method_buy_categories','method_buy_categories')
            ->with('edit',MethodBuyCategory::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MethodBuyCategory  $methodBuyCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'file|image|max:50000|mimes:jpeg,png,jpg',
        ]);
        $method_buy_category =MethodBuyCategory::find($id);
        $method_buy_category->name = $request->name;
        if($request->file('image')){
            $method_buy_category->image = $this->editImage($request,$method_buy_category,'method_buy_category_image');
        }
        $method_buy_category->save();

        return redirect()->route('method-buy-category.index')
        ->with('success','Update successful');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MethodBuyCategory  $methodBuyCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $method_buy_category =MethodBuyCategory::find($id);
        $this->delete($method_buy_category,'method_buy_category_image');
        $method_buy_category->delete();
        return back()->with('success','Delete successful');
    }
}
