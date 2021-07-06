<?php

namespace App\Http\Controllers;

use App\Models\LiveLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class LiveLinkController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        return view('liveLink')
            ->with('live_link',LiveLink::latest()->get());

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
            'link' => 'required|unique:live_links,link'
        ]);

        DB::table('live_links')->where('status',1)->update(['status' => 0]);

        $live_link = new LiveLink();
        $live_link->link = $request->link;
        $live_link->status = true;
        $live_link->save();

        return back()->with('success','Create new link successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LiveLink  $liveLink
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $link = LiveLink::find($id);
        if($link->status == 1){
            $link->status = 0 ;

        }else{
            DB::table('live_links')->where('status',1)->update(['status' => 0]);
            $link->status = 1 ;
        }
        $link->save();
        return back()->with('success','update status success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LiveLink  $liveLink
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('liveLink')
            ->with('live_link',LiveLink::latest()->get())
            ->with('edit',LiveLink::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LiveLink  $liveLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'link' => 'required|unique:live_links,link'
        ]);

        DB::table('live_links')->where('status',1)->update(['status' => 0]);

        $live_link = LiveLink::find($id);
        $live_link->link = $request->link;
        $live_link->status = true;
        $live_link->save();

        return redirect()->route('live-link.create')->with('success','Update successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LiveLink  $liveLink
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $liveLink = LiveLink::find($id);
        if($liveLink->status == 1){
            return back()->with('warning','Live link is active');
        }
        $liveLink->delete();
        return redirect()->route('live-link.create')->with('success','Delete successful');
    }
}
