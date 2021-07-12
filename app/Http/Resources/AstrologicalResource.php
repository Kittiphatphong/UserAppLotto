<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\Trail\GetDrawController;
use App\Models\AstrologicalDetail;
class AstrologicalResource extends JsonResource
{
   use GetDrawController;

    public function toArray($request)
    {
        return [
            "name" => $this->name,
            "count_teller" => $this->getCount()['count_teller'],
            "count_teller_correct" => $this->getCount()['count_teller_correct'],
            "percent_correct" =>  $this->getCount()['percent_correct'],
            "star" => $this->getCount()['star'],
            "image_astrological" =>$this->image,
            "list_teller" => AstrologicalDetailResource::collection(AstrologicalDetail::where('astrological_id',$this->id)->get())
        ];

    }
}
