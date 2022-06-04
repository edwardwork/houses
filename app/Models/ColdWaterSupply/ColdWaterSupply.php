<?php

namespace App\Models\ColdWaterSupply;

use App\Traits\HasManyHousesTrait;
use Carbon\Carbon;
use Database\Factories\ColdWaterSupply\ColdWaterSupplyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static ColdWaterSupplyFactory factory(...$parameters)
 */
class ColdWaterSupply extends Model
{
    use HasFactory;
    use HasManyHousesTrait;

    public const TABLE = 'cold_water_supplies';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
    ];
}
