<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $casts = [
        'animals_digit' => 'array',
        'digit' => 'array'
    ];

    public function animalNos(){
        return $this->hasMany(AnimalNo::class,'animal_id');
    }
    public function animalNo(){
        return $this->hasMany(AnimalNo::class,'animal_id');
    }
}
