<?php

namespace App\Models\City;

use App\Traits\HasManyHousesTrait;
use Database\Factories\City\CityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property string title
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static CityFactory factory(...$parameters)
 */
class City extends Model
{
    use HasFactory;

    use HasManyHousesTrait;

    public const TABLE = 'cities';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
    ];
}
