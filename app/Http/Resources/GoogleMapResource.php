<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GoogleMapResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'partner_name' => $this->partners->partner_name,
            'icon' => $this->partners->icon,
            'province' => $this->provinces->pr_name
        ];
    }
}
