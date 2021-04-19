<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billorder340 extends Model
{
    use HasFactory;
    protected $casts = [
        'digit' => 'array'
    ];
    public function orders(){
        return $this->belongsTo(BillOrder::class,'order_id');
    }

    public function storeWins($digit){
        $this->type_win =$digit;
        $this->save();
        $order = BillOrder::find($this->order_id);
        $order->status_win = 1 ;
        $order->total_win = $order->winAmount340();
        $order->save();
        activity()
            ->performedOn($order)
            ->useLog('bill win 3/40')
            ->withProperties(['attributes' => $order])
            ->log('updated');
    }

    public function sumWins(){
        switch ($this->type_win){
            case 3:
                $sum = $this->money * 6000;
                break;

            case 2:
                $sum = $this->money * 160;
                break;

            case 1:
                $sum = $this->money * 8;
                break;

            default:
                echo "Don't have this digit";
        }

        if($sum<1000000){
            $total = ($sum/1000)."K";
        }elseif ($sum>=1000000 && $sum<1000000000){
            $total =($sum/1000000)."M";
        }else{
            $total =($sum/1000000000)."B";
        }
        if($total ==0){
            $total=1;
        }
        return $total;
    }
}
