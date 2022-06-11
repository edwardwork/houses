<?php

namespace App\Nova\Filters\HouseType;

use App\Models\HouseType\HouseType;
use App\Nova\Filters\BaseTypesFilter;
use App\Services\Cache\CacheKeyService;

class HouseTypeTypesFilter extends BaseTypesFilter
{
    function getModelName(): string
    {
        return HouseType::class;
    }

    function getCacheKey(): string
    {
        return CacheKeyService::getCacheKeyForHouseTypesFilterValues();
    }

    function getRelationKey(): string
    {
        return 'house_type_id';
    }
}