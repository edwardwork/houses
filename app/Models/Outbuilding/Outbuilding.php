<?php

namespace App\Models\Outbuilding;

use App\Traits\HasManyHousesTrait;
use Carbon\Carbon;
use Database\Factories\Outbuilding\OutbuildingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static OutbuildingFactory factory(...$parameters)
 */
class Outbuilding extends Model
{
    use HasFactory;
    use HasManyHousesTrait;

    public const TABLE = 'outbuildings';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
    ];
}
