<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MethodBuyResource;
class MethodBuyCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'category_name' => $this->name,
            'category_image' => $this->image,
            'list' => MethodBuyResource::collection($this->methodBuys)
        ];
    }
}
