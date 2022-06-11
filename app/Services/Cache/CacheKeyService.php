<?php

namespace App\Services\Cache;

class CacheKeyService
{
    public const FILTER_VALUES_SUFFIX = 'filter_values';

    public static function getCacheKeyForHouseTypesFilterValues(): string
    {
        return 'house_types_' . static::FILTER_VALUES_SUFFIX;
    }

    public static function getCacheKeyForWallTypeFilterValues(): string
    {
        return 'wall_type_' . static::FILTER_VALUES_SUFFIX;
    }

    public static function getCacheKeyForColdWaterSupplyFilterValues(): string
    {
        return 'cold_water_supply_' . static::FILTER_VALUES_SUFFIX;
    }

    public static function getCacheKeyForHotWaterSupplyFilterValues(): string
    {
        return 'hot_water_supply_' . static::FILTER_VALUES_SUFFIX;
    }

    public static function getCacheKeyForSewerageFilterValues(): string
    {
        return 'sewerage_' . static::FILTER_VALUES_SUFFIX;
    }

    public static function getCacheKeyForGasFilterValues(): string
    {
        return 'gas_' . static::FILTER_VALUES_SUFFIX;
    }

    public static function getCacheKeyForElectricityFilterValues(): string
    {
        return 'electricity_' . static::FILTER_VALUES_SUFFIX;
    }

    public static function getCacheKeyForWarmFilterValues(): string
    {
        return 'warm_' . static::FILTER_VALUES_SUFFIX;
    }
}