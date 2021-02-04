<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

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
