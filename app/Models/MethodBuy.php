<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MethodBuy extends Model
{
    use HasFactory;

    public function methodBuyImages(){
        return $this->hasMany(MethodBuyImage::class,'method_buy_id');
    }
    public function methodBuySelectImages(){
        return $this->hasMany(MethodBuyImage::class,'method_buy_id');
    }
}
