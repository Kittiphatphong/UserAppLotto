<?php

namespace App\Http\Controllers;

use App\Models\TermCondition;
use Illuminate\Http\Request;

class TermConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $term = TermCondition::first()->get();
return view('termCondition.termIndex')
    ->with('term_index',$term);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $termCondition = new TermCondition();
        return view('termCondition.termCreate')
            ->with('term_index','term_index')
            ->with('term',$termCondition);
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
            'content' => 'required'
        ]);
        TermCondition::create($request->all());

        return redirect()->route('term-condition.index')->with('success','Created term and condition successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TermCondition  $termCondition
     * @return \Illuminate\Http\Response
     */
    public function show(TermCondition $termCondition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TermCondition  $termCondition
     * @return \Illuminate\Http\Response
     */
    public function edit(TermCondition $termCondition)
    {
        return view('termCondition.termCreate')
            ->with('term_index','term_index')
            ->with('term',$termCondition)
            ->with('edit','edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TermCondition  $termCondition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TermCondition $termCondition)
    {
        $request->validate([
           'title' => 'required',
           'content' => 'required'
        ]);
        $termCondition->update($request->all());

        return redirect()->route('term-condition.index')->with('success','Updated term and condition successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TermCondition  $termCondition
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermCondition $termCondition)
    {
        $termCondition->delete();

    }
}
