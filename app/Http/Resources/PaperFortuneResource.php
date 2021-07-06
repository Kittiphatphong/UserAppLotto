<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\Trail\MyFunction;
class PaperFortuneResource extends JsonResource
{
use MyFunction;
    public function toArray($request)
    {
        $count= strlen($this->no);
        $laoNumber = null;


        for($i=0;$i < strlen($this->no);$i++){
            $number = substr($this->no,$i,1);
            $laoNumber = $laoNumber.$this->laoNumber($number);


        }
        return [
            "no" => $this->no,
            "lao_no" => $laoNumber,
            "paper_image" => $this->paper_image,
        ];
    }
}
