<?php

namespace App\Http\Resources;

use App\Enums\Apartment\ApartmentEnum;
use App\Models\Apartment\Apartment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Apartment
 */
class ApartmentResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->title,
            'description' => $this->description,
            'price' => $this->getPriceAsText(),
            'building_type' => $this->houseType->title,
            'floor' => $this->floor,
            'rooms_number' => $this->room_count,
            'area' => $this->common_square,
            'kitchen_area' => $this->kitchen_square,
            'bathroom_type' => $this->bathroomType->title,
            'renovation' => $this->repair->title,
            'entrance_number' => $this->entrance,
            'photos' => PhotoResource::collection($this->getMedia(ApartmentEnum::PLANNING)),
        ];
    }
}