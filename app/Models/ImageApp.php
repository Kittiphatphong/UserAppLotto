<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ImageApp extends Model
{
    use HasFactory,LogsActivity;
    protected static $logName = 'background app';
    protected static $logAttributes = ['image','active'];
    protected static $logOnlyDirty = true;
}
