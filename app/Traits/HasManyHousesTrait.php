<?php

namespace App\Traits;

use App\Models\House\House;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @see HasManyHousesTrait::houses()
 */
trait HasManyHousesTrait
{
    public function houses(): HasMany
    {
        return $this->hasMany(House::class);
    }
}