<?php

namespace App\Nova\Filters\Sewerage;

use App\Models\Sewerage\Sewerage;
use App\Nova\Filters\BaseTypesFilter;
use App\Services\Cache\CacheKeyService;

class SewerageTypesFilter extends BaseTypesFilter
{
    public function name()
    {
        return __('Sewerage');
    }

    function getModelName(): string
    {
        return Sewerage::class;
    }

    function getCacheKey(): string
    {
        return CacheKeyService::getCacheKeyForSewerageFilterValues();
    }

    function getRelationKey(): string
    {
        return 'sewerage_id';
    }
}