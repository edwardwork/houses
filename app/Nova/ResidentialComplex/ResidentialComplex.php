<?php

namespace App\Nova\ResidentialComplex;

use App\Enums\ResidentialComplex\ResidentialComplexEnum;
use App\Nova\Developer\Developer;
use App\Nova\ResidentialHouse\ResidentialHouse;
use App\Nova\Resource;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class ResidentialComplex extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ResidentialComplex\ResidentialComplex::class;

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
        return __('Residential complex');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('Title'), 'title')->required(),
            Text::make(__('Price'), function () {
                    return $this->getPriceAsText();
                })
                ->readonly(),
            Text::make(__('Description'), 'description'),
            Text::make(__('Address'), 'address')->required(),
            Number::make(__('Built year'), 'built_year')->required(),
            Medialibrary::make(
                __('General plan'),
                ResidentialComplexEnum::GENERAL_PLAN,
                config('filesystems.residential_complex')
            )->accept('image/*'),
            Medialibrary::make(
                __('Videos'),
                ResidentialComplexEnum::VIDEOS_RESIDENTIAL_COMPLEX,
                config('filesystems.residential_complex')
            )->accept('video/*'),
            Medialibrary::make(
                __('Photos'),
                ResidentialComplexEnum::PHOTOS_RESIDENTIAL_COMPLEX,
                config('filesystems.residential_complex')
            )->accept('image/*'),
            Number::make(__('Lat'), 'lat')->min(1)->max(180)->step(0.01),
            Number::make(__('Lng'), 'lng')->min(1)->max(180)->step(0.01),
            BelongsTo::make(__('Developer'), 'developer', Developer::class)->required(),
            HasMany::make(__('Residential house'), 'residentialHouses', ResidentialHouse::class)->required()
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
        return [];
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
