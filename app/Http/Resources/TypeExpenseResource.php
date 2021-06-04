<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TypeExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->income_expense == 1){
            $type = "income";
        }else{
            $type = "expense";
        }

        return [
            "id" => $this->id,
            "name" => $this->name,
            "type" => $type ,
            "income_expense" => $this->income_expense

        ];
    }
}
