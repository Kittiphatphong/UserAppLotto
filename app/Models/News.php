<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public function newsImages(){
        return $this->hasMany(NewsImage::class,'news_id');
    }
    public function apiNewsImages(){
        return $this->hasMany(NewsImage::class,'news_id')->select('image');
    }
}
