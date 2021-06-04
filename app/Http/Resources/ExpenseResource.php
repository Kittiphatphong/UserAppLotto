<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->typeExpenses->income_expense === 1){
            $type = "income";
        }else{
            $type = "expense";
        }

        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'date' => $this->date,
            "type" => $type,
            "category" => $this->typeExpenses->name,
            "type_expense_id" => $this->type_expense_id,
            "customer_id" => $this->client_id,
            "description" => $this->description
        ];
    }
}
