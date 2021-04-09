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

    protected static $logAttributes = ['firstname', 'lastname','phone','birthday','gender','address','image','background_image','device_token','otps.otp_number'];

    protected static $logOnlyDirty = true;
    protected static $recordEvents = ['deleted'];
    protected static $logName = 'customer';

    public function makeCustomer($firstname,$lastname,$birthday,$gender,$village){
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->birthday = $birthday;
        $this->gender = $gender;
        $this->village = $village;

    }
    public function makeCustomerV2($gender,$pr_id,$dr_id,$village){
        $this->gender = $gender;
        $this->pr_id = $pr_id;
        $this->dr_id= $dr_id;
        $this->village = $village;
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
    public function province(){
        return $this->belongsTo(Province::class,'pr_id');
    }
    public function dristric(){
        return $this->belongsTo(Dristric::class,'dr_id');
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
