<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AstrologicalDetailResource extends JsonResource
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
            'digits' => $this->digit,
            'image' => $this->image,
            'draw_no' => $this->draws->draw,
            'draw_date' => $this->draws->draw_date,
            'status_correct' => $this->status
        ];
    }
}
