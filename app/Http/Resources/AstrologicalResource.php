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
//        $currently_teller = AstrologicalDetail::where('astrological_id',$this->id)
//            ->whereHas('draws',function ($q){
//                $q->where('draw',$this->getDraw()['draw_no']);
//            }) ;
//        if($currently_teller->count()>0){
//            $currently_teller = AstrologicalDetailResource::make($currently_teller->first());
//        }else{
//            $currently_teller = [];
//        }

        $count_teller = $this->details->count();
        $count_teller_correct = $this->details->where('status',1)->count();

        if($count_teller <= 0){
            $percent_correct =0;
        }else {
            $percent_correct = ($count_teller_correct * 100) / $count_teller;

        }
//            $count_teller = $this->getCount()['count_teller'];
//            $count_teller_correct = $this->getCount()['count_teller_correct'];
//            $percent_correct = $this->getCount()['percent_correct'];



        return [
            "name" => $this->name,
            "count_teller" => $count_teller,
            "count_teller_correct" => $count_teller_correct,
            "percent_correct" =>  $percent_correct,
//            "currently_teller" => $currently_teller,
            "list_teller" => AstrologicalDetailResource::collection(AstrologicalDetail::where('astrological_id',$this->id)->get())
        ];
    }
}
