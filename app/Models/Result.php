<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Result extends Model
{
    use HasFactory,LogsActivity;
    protected static $logName = 'result';
    protected static $logAttributes = ['draw','animal1','animal2','animal3','l2d3d4d5d6d'];
    protected static $logOnlyDirty = true;

    public function animal6ds(){
        return $this->belongsTo(Animal::class,'animal6d_id');
    }

    public function animal1s(){
        return $this->belongsTo(Animal::class,'animal1_id');
    }
    public function animal2s(){
        return $this->belongsTo(Animal::class,'animal2_id');
    }
    public function animal3s(){
        return $this->belongsTo(Animal::class,'animal3_id');
    }

    public function animal6drs(){
        return $this->belongsTo(Animal::class,'animal6d_id')->select('id','name','image');
    }

    public function animal1rs(){
        return $this->belongsTo(Animal::class,'animal1_id')->select('id','name','image');
    }
    public function animal2rs(){
        return $this->belongsTo(Animal::class,'animal2_id')->select('id','name','image');
    }
    public function animal3rs(){
        return $this->belongsTo(Animal::class,'animal3_id')->select('id','name','image');
    }
}
