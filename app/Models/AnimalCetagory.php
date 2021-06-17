<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalCetagory extends Model
{
    use HasFactory;

    public function withAnimals(){
        return $this->hasMany(AnimalWithCategory::class,'animal_category_id');
    }
}
