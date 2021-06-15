<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Astrological extends Model
{
    use HasFactory;

    public function details(){
        return $this->hasMany(AstrologicalDetail::class,'astrological_id');
    }
}
