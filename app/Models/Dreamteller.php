<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dreamteller extends Model
{
    use HasFactory;

    protected $casts = [
      'recommend_digits' => 'array'
    ];

    public function dreamTellerImages(){
        return $this->hasMany(DreamtellerImage::class,'dream_id')->select('id','image','dream_id');
    }
}
