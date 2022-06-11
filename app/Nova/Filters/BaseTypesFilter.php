<?php

namespace App\Nova\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Laravel\Nova\Filters\BooleanFilter;

abstract class BaseTypesFilter extends BooleanFilter
{
    /**
     * Apply the filter to the given query.
     *
     * @param Request $request
     * @param Builder $query
     * @param mixed $value
     * @return Builder
     */
    public function apply(Request $request, $query, $value)
    {
        $data = $this->loadInformationAboutModel();

        foreach ($data as $datum) {
            if ($value[$datum->id]) {
                $query->orWhere($this->getRelationKey(), $datum->id);
            }
        }

        return $query;
    }

    protected function loadInformationAboutModel()
    {
        return Cache::remember($this->getCacheKey(), now()->addMinutes(5), function () {
            return app($this->getModelName())::query()
                ->where('title', '!=', '')
                ->distinct('title')
                ->get();
        });
    }

    abstract function getCacheKey(): string;

    abstract function getModelName(): string;

    abstract function getRelationKey(): string;

    /**
     * Get the filter's available options.
     *
     * @param Request $request
     * @return array
     */
    public function options(Request $request)
    {
        return $this->loadInformationAboutModel()->pluck('id', 'title')->toArray();
    }
}