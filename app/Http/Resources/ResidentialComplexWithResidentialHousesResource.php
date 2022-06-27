<?php

namespace App\Http\Resources;

use App\Enums\ResidentialComplex\ResidentialComplexEnum;
use App\Models\ResidentialComplex\ResidentialComplex;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ResidentialComplex
 */
class ResidentialComplexWithResidentialHousesResource extends JsonResource
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
            'developer' => new DeveloperResource($this->developer),
            'built_year' => $this->built_year,
            'photos' => PhotoResource::collection($this->getMedia(ResidentialComplexEnum::PHOTOS_RESIDENTIAL_COMPLEX)),
            'videos' => PhotoResource::collection($this->getMedia(ResidentialComplexEnum::VIDEOS_RESIDENTIAL_COMPLEX)),
            'apartments_count' => $this->apartments_count,
            'houses' => ResidentialHouseResource::collection($this->residentialHouses),
            'created_at' => $this->created_at,
        ];
    }
}