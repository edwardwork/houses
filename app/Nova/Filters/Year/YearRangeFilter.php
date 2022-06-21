<?php

namespace App\Nova\Filters\Year;

use DigitalCreative\RangeInputFilter\RangeInputFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class YearRangeFilter extends RangeInputFilter
{
    public function name()
    {
        return __('Year');
    }

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->where('year', '>=', $value['from'])
            ->where('year', '<=', $value['to']);
    }

    public function options(Request $request) : array
    {
        return [
            'fromPlaceholder' => 0,
            'toPlaceholder' => 20,
            'dividerLabel' => 'to',
        ];
    }
}
