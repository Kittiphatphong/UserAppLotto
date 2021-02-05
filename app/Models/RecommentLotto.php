<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommentLotto extends Model
{
    use HasFactory;

    public function recommendImages(){
        return $this->hasMany(RecommentImage::class,'recommend_id');
    }
}
