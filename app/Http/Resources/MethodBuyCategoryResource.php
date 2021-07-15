<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MethodBuyResource;
class MethodBuyCategoryResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'category_name' => $this->name,
            'category_image' => $this->image,
            'item_list' => MethodBuyResource::collection($this->methodBuys)
        ];
    }
}
