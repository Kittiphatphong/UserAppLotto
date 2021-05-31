<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temple extends Model
{
    use HasFactory;
    public function fortunes(){
        return $this->hasMany(Fortune::class,'temple_id');
    }
    public function apiFortunes(){
        return $this->hasMany(Fortune::class,'temple_id')
            ->select('no','image as paper_image')
            ->orderBy('no');
    }
}
