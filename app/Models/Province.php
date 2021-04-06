<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    public function dristrics(){
        return $this->hasMany(Dristric::class,'pr_id');
    }
}
