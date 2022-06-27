<?php

namespace App\Http\Resources;

use App\Models\ResidentialComplex\ResidentialComplex;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ResidentialComplex
 */
class ResidentialComplexWithApartmentsResource extends JsonResource
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
            'apartments_count' => $this->apartments_count,
            'apartments' => ApartmentResource::collection($this->apartments),
            'created_at' => $this->created_at,
        ];
    }
}