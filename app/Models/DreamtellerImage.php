<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DreamtellerImage extends Model
{
    use HasFactory;

    public function dreamTellers(){
        return $this->belongsTo(Dreamteller::class,'dream_id');
    }
}
