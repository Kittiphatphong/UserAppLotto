<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fortune extends Model
{
    use HasFactory;
    public function temples(){
        return $this->belongsTo(Temple::class,"temple_id");
    }
}
