<?php

namespace App\Nova\Filters\ColdWaterSupply;

use App\Models\ColdWaterSupply\ColdWaterSupply;
use App\Models\Gas\Gas;
use App\Nova\Filters\BaseTypesFilter;
use App\Services\Cache\CacheKeyService;

class ColdWaterSupplyTypesFilter extends BaseTypesFilter
{
    function getModelName(): string
    {
        return ColdWaterSupply::class;
    }

    function getCacheKey(): string
    {
        return CacheKeyService::getCacheKeyForColdWaterSupplyFilterValues();
    }

    function getRelationKey(): string
    {
        return 'cold_water_supply_id';
    }
}