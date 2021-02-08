<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    public function typeNotifications(){
        return $this->belongsTo(Type_Notification::class,'type_id');
    }
    public function notification_customer(){
        return $this->hasMany(Customer_Notification::class,'notification_id');
    }

    public function newNotification($title,$content,$type_id){
        $this->title = $title;
        $this->content = $content;
        $this->type_id =$type_id;
        $this->save();
    }
}
