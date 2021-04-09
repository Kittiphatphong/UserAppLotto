<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Animal extends Model
{
    use HasFactory,LogsActivity;
    protected static $logName = 'animal';
    protected static $logAttributes = ['name','description','image','animals_digit','digit'];
    protected static $logOnlyDirty = true;

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
