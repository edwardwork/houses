<?php

namespace App\Http\Resources;

use App\Models\House\House;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin House
 */
class HouseResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'year' => $this->year,
            'floor' => $this->floor,
            'house_type' => $this->houseType?->title,
            'wall_type' => $this->wallType?->title,
            'full_address' => $this->address,
        ];
    }
}
