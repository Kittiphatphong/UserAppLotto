<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billorder2d3d4d5d6d extends Model
{
    use HasFactory;
    public function orders(){
        return $this->belongsTo(BillOrder::class,'order_id');
    }

    public function storeWins($digit){
        $this->status_win =$digit;
        $this->save();
        $order = BillOrder::find($this->order_id);
        $order->status_win = 1 ;
        $order->save();
    }
}
