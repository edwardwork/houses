<?php

namespace App\Nova\ResidentialHouse;

use App\Enums\ResidentialHouse\ResidentialHouseEnum;
use App\Nova\HouseType\HouseType;
use App\Nova\Microdistrict\Microdistrict;
use App\Nova\ResidentialComplex\ResidentialComplex;
use App\Nova\Resource;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class ResidentialHouse extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ResidentialHouse\ResidentialHouse::class;

    public static $group = 'Главное';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
        'description',
        'address',
    ];

    public static function label()
    {
        return __('Residential house');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('Title'), 'title')->required(),
            Text::make(__('Description'), 'description'),
            Text::make(__('Address'), 'address')->required(),
            BelongsTo::make(__('Microdistrict'), 'microdistrict', Microdistrict::class),
            Medialibrary::make(
                __('Construction progress'),
                ResidentialHouseEnum::PHOTO_CONSTRUCTION_PROGRESS,
                config('filesystems.residential_house')
            )->accept('image/*'),
            Number::make('lat')->min(1)->max(180)->step(0.01),
            Number::make('lng')->min(1)->max(180)->step(0.01),
            BelongsTo::make(__('House type'), 'houseType', HouseType::class)->required(),
            BelongsTo::make(__('Residential complex'), 'residentialComplex', ResidentialComplex::class)->required()
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
        return [];
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
