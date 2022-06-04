<?php

namespace App\Models\HotWaterSupply;

use App\Traits\HasManyHousesTrait;
use Carbon\Carbon;
use Database\Factories\HotWaterSupply\HotWaterSupplyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static HotWaterSupplyFactory factory(...$parameters)
 */
class HotWaterSupply extends Model
{
    use HasFactory;
    use HasManyHousesTrait;

    public const TABLE = 'hot_water_supplies';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
    ];
}
