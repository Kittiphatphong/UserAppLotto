<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MethodBuyResource extends JsonResource
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
          'title' => $this->title,
          'description' => $this->description,
          'youtube_link' => $this->link,
          'images' => $this->methodBuyImages->pluck('image')
        ];
    }
}
