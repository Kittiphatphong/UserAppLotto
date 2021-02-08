<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_Notification extends Model
{
    use HasFactory;

    public function customers(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function notifications(){
        return $this->belongsTo(Notification::class,'notification_id');
    }

    public function newCustomerNotification($customer_id,$notification_id){
        $this->customer_id = $customer_id;
        $this->notification_id = $notification_id;
        $this->save();
    }
}
