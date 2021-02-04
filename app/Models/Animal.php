<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    public function animalNos(){
        return $this->hasMany(AnimalNo::class,'animal_id');
    }
    public function animalNo(){
        return $this->hasMany(AnimalNo::class,'animal_id')->select('animal_id','no');
    }
}
