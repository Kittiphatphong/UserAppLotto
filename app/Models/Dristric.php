<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dristric extends Model
{
    use HasFactory;
    public function provinces(){
        return $this->belongsTo(Province::class,'pr_id');
    }
}
