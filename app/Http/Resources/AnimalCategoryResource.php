<?php

namespace App\Http\Resources;

use App\Models\AnimalWithCategory;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\WithAniamlResource;
class AnimalCategoryResource extends JsonResource
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
            'categoryName' => $this->name,
            'categoryImage' => $this->image,
            'categoryList' => WithAniamlResource::collection($this->withAnimals),
        ];
    }
}
