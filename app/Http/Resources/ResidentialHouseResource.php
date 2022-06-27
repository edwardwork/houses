<?php

namespace App\Http\Resources;

use App\Enums\Apartment\ApartmentEnum;
use App\Models\Apartment\Apartment;
use App\Models\ResidentialHouse\ResidentialHouse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ResidentialHouse
 */
class ResidentialHouseResource extends JsonResource
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
            'address' => $this->address,
            'entrances' => $this->apartments->groupBy('entrance')->map(function ($items) use ($request) {
                $items = $items->map(function (Apartment $apartment) use ($request){
                    return (new ApartmentResource($apartment))->toArray($request);
                });

                return $items;
            }),
            'photos' => PhotoResource::collection($this->getMedia(ApartmentEnum::PLANNING)),
        ];
    }
}