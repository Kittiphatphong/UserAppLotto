<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Astrological;
use App\Models\AstrologicalDetail;
use App\Models\Draw;
use App\Models\Fortune;
use Illuminate\Http\Request;
use App\Http\Controllers\Trail\GetDrawController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AstrologicalDetailController extends Controller
{
    use GetDrawController;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('astrologicalDetail.astrologicalDetailList')
            ->with('astrologicalDetail',AstrologicalDetail::latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('astrologicalDetail.astrologicalDetailCreate')
            ->with('astrologicalDetail','astrologicalDetail')
            ->with('astrological_list',Astrological::latest()->get())
            ->with('draw',$this->getDraw())
            ->with('animals',Animal::all());
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
            'astrological_id' => 'required',
            'image' => 'required|file|image|max:50000|mimes:jpeg,png,jpg',
            'animals' => 'required',
        ]);

        if (in_array($this->getDraw()['draw_no'],Draw::all()->pluck('draw')->toArray())){
            $draw = Draw::latest()->first();

        }else{
            $draw = new Draw();
            $draw->draw = 11111;
            $draw->draw_date = $this->getDraw()['draw_date'];
            $draw->save();
        }
        $astrological_draw = AstrologicalDetail::all()->where('astrological_id',$request->astrological_id)->pluck('draw_id')->toArray();
        if (in_array($draw->id,$astrological_draw)){
           return back()->with('warning','Astrological is Exist');
        }


        $stringImageReformat = base64_encode('_'.time());
        $ext = $request->file('image')->getClientOriginalExtension();
        $imageName = $stringImageReformat.".".$ext;
        $imageEncode = File::get($request->image);


        $digit = [];
        foreach ($request->animals as $animal){
            $animals_digit = Animal::find($animal);
            foreach ($animals_digit->animals_digit as $item){
                array_push($digit,$item);
            }
        }

        $astrological_detail = New AstrologicalDetail();
        $astrological_detail->digit = json_encode($digit);
        $astrological_detail->image = "/storage/astrological_image/".$imageName;
        $astrological_detail->astrological_id = $request->astrological_id;
        $astrological_detail->draw_id = $draw->id;
        $astrological_detail->save();

        Storage::disk('local')->put('public/astrological_image/'.$imageName, $imageEncode);

      return redirect()->route('astrological-detail.index')->with('Create successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('astrologicalDetail.astrologicalDetailCreate')
            ->with('astrologicalDetail','astrologicalDetail')
            ->with('astrological_list',Astrological::latest()->get())
            ->with('draw',$this->getDraw())
            ->with('animals',Animal::all())
            ->with('edit',AstrologicalDetail::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'file|image|max:50000|mimes:jpeg,png,jpg',
            'animals' => 'required',
        ]);

        $digit = [];
        foreach ($request->animals as $animal){
            $animals_digit = Animal::find($animal);
            foreach ($animals_digit->animals_digit as $item){
                array_push($digit,$item);
            }
        }

        $astrological_detail =  AstrologicalDetail::find($id);
        $astrological_detail->digit = json_encode($digit);

        $astrological_detail->save();

        if($request->hasFile("image")){
            Storage::delete("public/astrological_image/".str_replace('/storage/astrological_image/','',$astrological_detail->image));
            $request->image->storeAs("public/astrological_image",str_replace('/storage/astrological_image/','',$astrological_detail->image));
        }

        return redirect()->route('astrological-detail.index')->with('Update successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $astrological_detail =  AstrologicalDetail::find($id);
        $astrological_detail->delete();
        Storage::delete("public/astrological_image/".str_replace('/storage/astrological_image/','',$astrological_detail->image));
        return redirect()->route('astrological-detail.index')->with('Delete successful');
    }
}
