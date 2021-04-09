<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Dristric extends Model
{
    use HasFactory,LogsActivity;


    public $timestamps = false;
    protected static $logName = 'district';
    protected static $logAttributes = ['dr_name','dr_name_en','pr_id'];
    protected static $logOnlyDirty = true;
    public function provinces(){
        return $this->belongsTo(Province::class,'pr_id');
    }
}
