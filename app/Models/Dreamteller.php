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

    public function makeDreamTeller($recommendDigits,$title,$contentShow){
        $pieces = explode(",", $recommendDigits);
        $this->title = $title;
        $this->content = $contentShow;
        $this->recommend_digits = $pieces;
        $this->save();
    }
}
