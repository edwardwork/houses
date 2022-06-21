<?php

namespace App\Nova\Filters\HotWaterSupply;

use App\Models\HotWaterSupply\HotWaterSupply;
use App\Nova\Filters\BaseTypesFilter;
use App\Services\Cache\CacheKeyService;

class HotWaterSupplyTypesFilter extends BaseTypesFilter
{
    public function name()
    {
        return __('Hot water supply');
    }

    function getModelName(): string
    {
        return HotWaterSupply::class;
    }

    function getCacheKey(): string
    {
        return CacheKeyService::getCacheKeyForHotWaterSupplyFilterValues();
    }

    function getRelationKey(): string
    {
        return 'hot_water_supply_id';
    }
}