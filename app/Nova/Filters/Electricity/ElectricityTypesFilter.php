<?php

namespace App\Nova\Filters\Electricity;

use App\Models\Electricity\Electricity;
use App\Nova\Filters\BaseTypesFilter;
use App\Services\Cache\CacheKeyService;

class ElectricityTypesFilter extends BaseTypesFilter
{
    function getModelName(): string
    {
        return Electricity::class;
    }

    function getCacheKey(): string
    {
        return CacheKeyService::getCacheKeyForElectricityFilterValues();
    }

    function getRelationKey(): string
    {
        return 'electricity_id';
    }
}
