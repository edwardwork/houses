<?php

namespace App\Nova\Filters\Gas;

use App\Models\Gas\Gas;
use App\Nova\Filters\BaseTypesFilter;
use App\Services\Cache\CacheKeyService;

class GasTypesFilter extends BaseTypesFilter
{
    public function name()
    {
        return __('Gas');
    }

    function getModelName(): string
    {
        return Gas::class;
    }

    function getCacheKey(): string
    {
        return CacheKeyService::getCacheKeyForGasFilterValues();
    }

    function getRelationKey(): string
    {
        return 'gas_id';
    }
}