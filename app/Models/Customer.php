<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;
class Customer extends Model
{
    use HasApiTokens, HasFactory, Notifiable,LogsActivity;

    protected static $logAttributes = ['firstname', 'lastname','password','birthday','gender','address','status','image','background_image','device_token','otps.otp_number'];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "Customer has been {$eventName}";
    }
    protected static $logOnlyDirty = true;
    protected static $logName = 'Customer';

    public function makeCustomer($firstname,$lastname,$birthday,$gender,$address){
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->birthday = $birthday;
        $this->gender = $gender;
        $this->address = $address;
    }
    public function makeCustomerV2($gender,$address){
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
    public function requestNewOTPAgain(){
        $otps = OTP::where('customer_id',$this->id)->pluck('id');
        $otp = OTP::find($otps->first());
        $otp->otp_number = rand(1000,9999);
        $otp->save();
    }


}
