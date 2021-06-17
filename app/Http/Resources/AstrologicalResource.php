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


        return [
            "name" => $this->name,

        ];
    }
}
