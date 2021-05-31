<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleMap extends Model
{
    use HasFactory;

    public function partners(){
        return $this->belongsTo(Partner::class,'partner_id');
}
public function provinces(){
        return $this->belongsTo(Province::class,'pr_id');
}
}
