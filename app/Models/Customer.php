<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
class Customer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    public function makeCustomer($firstname,$lastname,$phone,$password,$birthday,$gender){
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->phone = $phone;
        $this->password = Hash::make($password);
        $this->birthday = $birthday;
        $this->gender = $gender;
    }

    public function otps(){
        return $this->hasOne(OTP::class);
    }
}
