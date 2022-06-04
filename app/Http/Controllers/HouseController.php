<?php

namespace App\Http\Controllers;

use App\Http\Resources\HouseResource;
use App\Models\House\House;

class HouseController extends Controller
{
    public function show(string $fiasCode): HouseResource
    {
        return new HouseResource(
            House::query()
                ->where('fias_code', $fiasCode)
                ->first()
        );
    }
}
