<?php

namespace App\Nova\Apartment;

use App\Enums\Apartment\ApartmentEnum;
use App\Nova\BathroomType\BathroomType;
use App\Nova\HouseType\HouseType;
use App\Nova\Outbuilding\Outbuilding;
use App\Nova\Repair\Repair;
use App\Nova\ResidentialHouse\ResidentialHouse;
use App\Nova\Resource;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class Apartment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Apartment\Apartment::class;

    public static $group = 'Главное';

    public static function label()
    {
        return __('Apartment');
    }

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

            Text::make(__('Title'), 'title')->required(),
            Text::make(__('Description'), 'description'),
            Text::make(__('Price'), 'price')->required(),

            BelongsTo::make(__('House type'), 'houseType', HouseType::class)->required(),

            Number::make(__('Floor'), 'floor')->required(),
            Number::make(__('Room count'), 'room_count')->required(),
            Number::make(__('Common square'), 'common_square')->step(0.1)->required(),
            Number::make(__('Kitchen square'), 'kitchen_square')->step(0.1)->required(),

            BelongsTo::make(__('Outbuilding'), 'outbuilding', Outbuilding::class)->required(),
            BelongsTo::make(__('Bathroom'), 'bathroomType', BathroomType::class)->required(),
            BelongsTo::make(__('Repair'), 'repair', Repair::class)->required(),

            Medialibrary::make(__('Facades'), ApartmentEnum::PLANNING, config('filesystems.apartment')),

            BelongsTo::make(__('Residential house'), 'residentialHouse', ResidentialHouse::class)->required(),

            Number::make(__('Entrance'), 'entrance')->required(),
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
