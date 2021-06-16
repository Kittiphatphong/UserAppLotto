<?php

namespace App\Http\Resources;

use App\Http\Resources\AstrologicalDetailResource;

use App\Models\AstrologicalDetail;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\Trail\GetDrawController;
class AstrologicalResource extends JsonResource
{
    use GetDrawController;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $currently_teller = AstrologicalDetail::where('astrological_id',$this->id)
            ->whereHas('draws',function ($q){
                $q->where('draw',$this->getDraw()['draw_no']);
            }) ;
        if($currently_teller->count()>0){
            $currently_teller = AstrologicalDetailResource::make($currently_teller->first());
        }else{
            $currently_teller = [];
        }

        return [
            "name" => $this->name,
            "currently_teller" => $currently_teller,
            "list_teller" => AstrologicalDetailResource::collection(AstrologicalDetail::where('astrological_id',$this->id)->get())
        ];
    }
}
