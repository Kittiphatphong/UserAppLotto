<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_Notification extends Model
{
    use HasFactory;

    public function notifications(){
        return $this->hasMany(Notification::class,'type_id');
}
}
