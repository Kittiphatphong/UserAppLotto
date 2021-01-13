<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillOrder extends Model
{
    use HasFactory;

    public function customers(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function billorder2d3d4d5d6ds(){
        return $this->hasMany(Billorder2d3d4d5d6d::class,'order_id');
    }
    public function bill340s(){
        return $this->hasMany(Billorder340::class,'order_id');
    }
    public function checkWin340s(){
        return $this->hasMany(Billorder340::class,'order_id')->where('animal1','=','14')->count();
    }
}
