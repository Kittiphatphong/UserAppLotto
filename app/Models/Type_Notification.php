<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Type_Notification extends Model
{
    use HasFactory,LogsActivity;
    protected static $logName = 'notification_type';
    protected static $logAttributes = ['name','icon'];
    protected static $logOnlyDirty = true;

    public function notifications(){
        return $this->hasMany(Notification::class,'type_id');
}
}
