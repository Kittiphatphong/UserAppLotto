<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TermCondition extends Model
{
    use HasFactory,LogsActivity;

    protected static $logName = 'term and condition';
    protected static $logAttributes = ['title','content'];
    protected static $logOnlyDirty = true;

    protected $fillable = ['title','content'];
}
