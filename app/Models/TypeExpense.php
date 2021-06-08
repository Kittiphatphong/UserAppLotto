<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeExpense extends Model
{
    use HasFactory;
    protected $fillable = ['name','income_expense'];

    public function expenses(){
        return $this->hasMany(Expense::class,'type_expense_id');
    }
}
