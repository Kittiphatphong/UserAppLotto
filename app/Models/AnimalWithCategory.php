<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalWithCategory extends Model
{
    use HasFactory;

    public function animals(){
        return $this->belongsTo(Animal::class,'animal_id');
    }
    public function apiAnimals(){
        return $this->belongsTo(Animal::class,'animal_id')
            ->select('name','description','image','animals_digit','digit');
    }
    public function animal_categories(){
        return $this->belongsTo(AnimalCetagory::class,'animal_category_id');
    }
}
