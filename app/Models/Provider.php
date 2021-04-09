<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Traits\LogsActivity;

class Provider extends Model
{
    use HasApiTokens, HasFactory, Notifiable,LogsActivity;

    protected static $logName = 'provider';
    protected static $logAttributes = ['provider_name','password'];
    protected static $logOnlyDirty = true;

    public function makeProvider($name,$password){
        $this->provider_name = $name;
        $this->password = Hash::make($password);
}
}
