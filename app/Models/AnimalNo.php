<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalNo extends Model
{
    use HasFactory;

    public function animals(){
        return $this->belongsTo(Animal::class,'animal_id');
    }
}
