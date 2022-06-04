<?php

namespace App\Models\HouseType;

use App\Traits\HasManyHousesTrait;
use Carbon\Carbon;
use Database\Factories\HouseType\HouseTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static HouseTypeFactory factory(...$parameters)
 */
class HouseType extends Model
{
    use HasFactory;
    use HasManyHousesTrait;

    public const TABLE = 'house_types';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
    ];
}
