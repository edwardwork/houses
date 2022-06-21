<?php

namespace App\Nova\Filters\Warm;

use App\Models\Warm\Warm;
use App\Nova\Filters\BaseTypesFilter;
use App\Services\Cache\CacheKeyService;

class WarmTypesFilter extends BaseTypesFilter
{
    public function name()
    {
        return __('Warm');
    }

    function getModelName(): string
    {
        return Warm::class;
    }

    function getCacheKey(): string
    {
        return CacheKeyService::getCacheKeyForWarmFilterValues();
    }

    function getRelationKey(): string
    {
        return 'warm_id';
    }
}
