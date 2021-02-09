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
}
