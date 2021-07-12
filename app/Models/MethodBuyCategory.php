<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MethodBuyCategory extends Model
{
    use HasFactory;
    public function methodBuys(){
        return $this->hasMany(MethodBuy::class,'method_buy_category_id');
    }
}
