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

   public function sumWins($digit){
       switch ($digit){
           case 6:
               $sum = $this->money * 400000;
               break;

           case 5:
               $sum = $this->money * 40000;
               break;

           case 4:
               $sum = $this->money * 5000;
               break;

           case 3:
               $sum = $this->money * 500;
               break;

           case 2:
               $sum = $this->money * 60;
               break;

           default:
               echo "Don't have this digit";
       }

       return $sum;
   }
}
