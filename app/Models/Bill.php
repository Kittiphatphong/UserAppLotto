<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $casts = [
        'digit' => 'array'
    ];
    public function newBill($customer_id,$bill_number,$draw,$type,$money,$digit){
        $this->customer_id = $customer_id;
        $this->bill_number = $bill_number;
        $this->draw = $draw;
        $this->type = $type;
        $this->money = $money;
        $this->digit = $digit;
        $this->save();
    }

    public function storeWin6ds($digit){
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
        $this->status_win = 1 ;
        $this->type_win =$digit;
        $this->total_win = $sum;
        $this->save();
    }
    public function storeWin340s($digit){
        switch ($digit){
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
        $this->status_win = 1 ;
        $this->type_win = $digit;
        $this->total_win = $sum;
        $this->save();
    }





    public function customers(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
