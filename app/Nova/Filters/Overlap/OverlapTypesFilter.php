<?php

namespace App\Nova\Filters\Overlap;

use App\Models\Overlap\Overlap;
use App\Nova\Filters\BaseTypesFilter;
use App\Services\Cache\CacheKeyService;

class OverlapTypesFilter extends BaseTypesFilter
{
    public function name()
    {
        return __('Overlap');
    }

    function getModelName(): string
    {
        return Overlap::class;
    }

    function getCacheKey(): string
    {
        return CacheKeyService::getCacheKeyForOverlapFilterValues();
    }

    function getRelationKey(): string
    {
        return 'overlap_id';
    }
}
