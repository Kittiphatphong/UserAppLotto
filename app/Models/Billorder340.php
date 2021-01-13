<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billorder340 extends Model
{
    use HasFactory;

    public function orders(){
        return $this->belongsTo(BillOrder::class,'order_id');
    }
    public function bills(){
        return $this->where('animal1','03')->first();
    }
}
