<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $casts = [
        'massages' => 'array'
    ];
    public function typeNotifications(){
        return $this->belongsTo(Type_Notification::class,'type_id')->select('id','name','icon');
    }
    public function notification_customer(){
        return $this->hasMany(Customer_Notification::class,'notification_id');
    }
    public function notification_customers(){
        return $this->hasMany(Customer_Notification::class,'notification_id')->select('id','read_status','notification_id');
    }

    public function newNotification($title,$content,$type_id,$massages){
        $this->title = $title;
        $this->body = $content;
        $this->type_id =$type_id;
        $this->massages =$massages;
        $this->save();
    }
}
