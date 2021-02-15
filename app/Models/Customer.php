<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
class Customer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    public function makeCustomer($firstname,$lastname,$birthday,$gender,$address){
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->birthday = $birthday;
        $this->gender = $gender;
        $this->address = $address;
    }
    public function newCustomer($phone,$password){
        $this->phone = $phone;
        $this->password = Hash::make($password);

    }

    public function bills(){
        return $this->hasMany(Bill::class,'customer_id');
    }
    public function otps(){
        return $this->hasOne(OTP::class);
    }

    public function orders(){
        return $this->hasMany(BillOrder::class);
    }

    public function customer_notification(){
        return $this->hasMany(Customer_Notification::class,'customer_id');
    }
    public function notification(){
        return $this->hasMany(Customer_Notification::class,'customer_id')->where('read_status',false);

    }

    public function requestNewOTP(){
        $otp = new OTP();
        $otp->customer_id = $this->id;
        $otp->otp_number = rand(1000,9999);
        $otp->save();

    }
}
