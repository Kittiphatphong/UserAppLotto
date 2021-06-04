<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = ['amount','income_expense','date','type_expense_id','app_name','client_id'];

    public function typeExpenses(){
        return $this->belongsTo(TypeExpense::class,'type_expense_id');
    }
}
