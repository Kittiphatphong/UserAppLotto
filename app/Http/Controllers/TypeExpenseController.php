<?php

namespace App\Http\Controllers;

use App\Models\TypeExpense;
use Illuminate\Http\Request;

class TypeExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('expense.expenseType')
            ->with('expense_type',TypeExpense::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expense.expenseCreate')
            ->with('expense_type','expense_type');
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
            'name' => 'required'
        ]);

        TypeExpense::create($request->all());
        return redirect()->route('expense-type.index')->with('success','Created new type expense');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeExpense  $typeExpense
     * @return \Illuminate\Http\Response
     */
    public function show(TypeExpense $typeExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeExpense  $typeExpense
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('expense.expenseCreate')
            ->with('expense_type','expense_type')
            ->with('edit',TypeExpense::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeExpense  $typeExpense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $typeExpense = TypeExpense::find($id);
        $typeExpense->name = $request->name;
        $typeExpense->save();
        return redirect()->route('expense-type.index')->with('success','Updated type expense');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeExpense  $typeExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeExpense $typeExpense)
    {
        //
    }
}
