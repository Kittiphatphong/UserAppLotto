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

    public function getCount(){
        $count_teller = $this->details->count();
        $count_teller_correct = $this->details->where('status',1)->count();

        if($count_teller <=0){
            $percent_correct =0;
            $star = 0;
        }else{
        $percent_correct = ($count_teller_correct*100)/$count_teller;
        $star = 5* $percent_correct/(100);
        }
        return [
            'count_teller' =>  $count_teller,
            'count_teller_correct' => $count_teller_correct,
            'percent_correct' => (string) $percent_correct,
            'star' => (string) round($star)
        ];
}
}
