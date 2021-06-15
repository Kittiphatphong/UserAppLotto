<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AstrologicalDetail extends Model
{
    use HasFactory;
    protected $casts = [
        'digits' => 'array'
    ];

    public function astrologicals(){
        return $this->belongsTo(Astrological::class,'astrological_id');
    }
    public function draws(){
        return $this->belongsTo(Draw::class,'draw_id');
    }
}
