<?php

namespace App\Nova\House;

use App\Enums\House\HouseEnum;
use App\Enums\Permissions\PermissionType;
use App\Enums\Roles\RoleType;
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
use App\Nova\Resource;
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

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

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
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')
                ->hideFromIndex()
                ->sortable(),

            Text::make('Address', function () {
                return $this->address;
            })->onlyOnIndex(),

            Medialibrary::make('Facades', HouseEnum::FACADES, config('filesystems.house'))
                ->hideFromIndex(),
            Medialibrary::make('Territory', HouseEnum::TERRITORY, config('filesystems.house'))
                ->hideFromIndex(),
            Medialibrary::make('Entrance', HouseEnum::ENTRANCE, config('filesystems.house'))
                ->hideFromIndex(),
            Medialibrary::make('Entrance enter', HouseEnum::ENTRANCE_ENTER, config('filesystems.house'))
                ->hideFromIndex(),

            Text::make('fias_code')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),
            Text::make('zone')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),
            Text::make('number')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),
            Number::make('year')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),
            Number::make('floor')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),
            Number::make('entrance')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),

            BelongsTo::make('microdistrict')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                }),

            BelongsTo::make('street')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),

            BelongsTo::make('wallType')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),

            BelongsTo::make('overlap')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),

            BelongsTo::make('outbuilding')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),

            BelongsTo::make('coldWaterSupply')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),

            BelongsTo::make('hotWaterSupply')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),

            BelongsTo::make('sewerage')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),

            BelongsTo::make('gas', 'gas', Gas::class)
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                })
                ->hideFromIndex(),

            BelongsTo::make('warm')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                }),

            BelongsTo::make('houseType')
                ->readonly(function ($request) {
                    return !$request->user()->can(PermissionType::UPDATE);
                }),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
