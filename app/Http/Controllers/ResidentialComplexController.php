<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResidentialComplexResource;
use App\Http\Resources\ResidentialComplexWithApartmentsResource;
use App\Http\Resources\ResidentialComplexWithResidentialHousesResource;
use App\Models\ResidentialComplex\ResidentialComplex;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ResidentialComplexController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return ResidentialComplexResource::collection(
            QueryBuilder::for(ResidentialComplex::class)
                ->allowedIncludes(['developer', 'apartments'])
                ->withCount('apartments')
                ->allowedSorts('price', 'created_at')
                ->allowedFilters(
                    [
                        'title',
                        AllowedFilter::scope('contains_room'),
                        AllowedFilter::scope('price_between'),
                    ]
                )
                ->paginate()
        );
    }

    public function indexWithApartments(Request $request): AnonymousResourceCollection
    {
        return ResidentialComplexWithApartmentsResource::collection(
            QueryBuilder::for(ResidentialComplex::class)
                ->allowedIncludes(['developer', 'apartments'])
                ->withCount('apartments')
                ->allowedSorts('price', 'created_at')
                ->allowedFilters(
                    [
                        'title',
                        AllowedFilter::scope('contains_room'),
                        AllowedFilter::scope('price_between'),
                    ]
                )
                ->paginate()
        );
    }

    public function indexWithResidentialHouses(Request $request): AnonymousResourceCollection
    {
        return ResidentialComplexWithResidentialHousesResource::collection(
            QueryBuilder::for(ResidentialComplex::class)
                ->allowedIncludes(['developer', 'apartments'])
                ->withCount('apartments')
                ->allowedSorts('price', 'created_at')
                ->allowedFilters(
                    [
                        'title',
                        AllowedFilter::scope('contains_room'),
                        AllowedFilter::scope('price_between'),
                    ]
                )
                ->paginate()
        );
    }
}