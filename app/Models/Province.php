<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Province extends Model
{
    use HasFactory,LogsActivity;

    public $timestamps = false;

    protected static $logName = 'province';
    protected static $logAttributes = ['pr_name','pr_name_en'];
    protected static $logOnlyDirty = true;

    public function districts(){
        return $this->hasMany(Dristric::class,'pr_id');
    }
}
