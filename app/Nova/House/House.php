<?php

namespace App\Nova\House;

use App\Enums\House\HouseEnum;
use App\Enums\Permissions\PermissionType;
use App\Nova\City\City;
use App\Nova\ColdWaterSupply\ColdWaterSupply;
use App\Nova\Filters\ColdWaterSupply\ColdWaterSupplyTypesFilter;
use App\Nova\Filters\Electricity\ElectricityTypesFilter;
use App\Nova\Filters\Gas\GasTypesFilter;
use App\Nova\Filters\HotWaterSupply\HotWaterSupplyTypesFilter;
use App\Nova\Filters\HouseType\HouseTypeTypesFilter;
use App\Nova\Filters\Overlap\OverlapTypesFilter;
use App\Nova\Filters\Sewerage\SewerageTypesFilter;
use App\Nova\Filters\Warm\WarmTypesFilter;
use App\Nova\Filters\Year\YearRangeFilter;
use App\Nova\Gas\Gas;
use App\Nova\HotWaterSupply\HotWaterSupply;
use App\Nova\HouseType\HouseType;
use App\Nova\Microdistrict\Microdistrict;
use App\Nova\Outbuilding\Outbuilding;
use App\Nova\Overlap\Overlap;
use App\Nova\Resource;
use App\Nova\Sewerage\Sewerage;
use App\Nova\Street\Street;
use App\Nova\WallType\WallType;
use App\Nova\Warm\Warm;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class House extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\House\House::class;

    public static function label()
    {
        return __('Houses');
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'address';

    public static $group = 'Главное';

    public static $showColumnBorders = true;

    public static $with = [
        'microdistrict',
        'street',
        'wallType',
        'overlap',
        'outbuilding',
        'coldWaterSupply',
        'hotWaterSupply',
        'sewerage',
        'gas',
        'electricity',
        'warm',
        'houseType',
    ];

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'address',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')
                ->hideFromIndex()
                ->sortable(),

            Text::make(__('Address'), 'address', function () {
                return $this->address;
            })->onlyOnIndex(),

            Medialibrary::make(__('Facades'), HouseEnum::FACADES, config('filesystems.house'))
                ->hideFromIndex(),
            Medialibrary::make(__('Territory'), HouseEnum::TERRITORY, config('filesystems.house'))
                ->hideFromIndex(),
            Medialibrary::make(__('Entrance'), HouseEnum::ENTRANCE, config('filesystems.house'))
                ->hideFromIndex(),
            Medialibrary::make(__('Entrance enter'), HouseEnum::ENTRANCE_ENTER, config('filesystems.house'))
                ->hideFromIndex(),

            Text::make(__('Fias code'), 'fias_code')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),
            Text::make(__('Zone'), 'zone')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),
            Text::make(__('Number'), 'number')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),
            Number::make(__('Year'), 'year')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                }),
            Number::make(__('Floor'), 'floor')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),
            Number::make(__('Entrance'), 'entrance')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),

            BelongsTo::make(__('Microdistrict'), 'microdistrict', Microdistrict::class)
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                }),

            BelongsTo::make(__('Street'), 'street', Street::class)
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),

            BelongsTo::make(__('Wall type'), 'wallType', WallType::class)
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),

            BelongsTo::make(__('Overlap'), 'overlap', Overlap::class)
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),

            BelongsTo::make(__('Outbuilding'), 'outbuilding', Outbuilding::class)
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),

            BelongsTo::make(__('Cold water supply'), 'coldWaterSupply', ColdWaterSupply::class)
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),

            BelongsTo::make(__('Hot water supply'), 'hotWaterSupply', HotWaterSupply::class)
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),

            BelongsTo::make(__('Sewerage'), 'sewerage', Sewerage::class)
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),

            BelongsTo::make(__('Gas'), 'gas', Gas::class)
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),

            BelongsTo::make(__('Warm'), 'warm', Warm::class)
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                }),

            BelongsTo::make(__('House type'), 'houseType', HouseType::class)
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                }),

            BelongsTo::make(__('City'), 'city', City::class)
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                }),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new YearRangeFilter(),
            new OverlapTypesFilter(),
            new HouseTypeTypesFilter(),
            new HotWaterSupplyTypesFilter(),
            new ColdWaterSupplyTypesFilter(),
            new SewerageTypesFilter(),
            new GasTypesFilter(),
            new ElectricityTypesFilter(),
            new WarmTypesFilter(),
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
