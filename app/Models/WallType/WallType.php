<?php

namespace App\Models\WallType;

use App\Traits\HasManyHousesTrait;
use Carbon\Carbon;
use Database\Factories\WallType\WallTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static WallTypeFactory factory(...$parameters)
 */
class WallType extends Model
{
    use HasFactory;
    use HasManyHousesTrait;

    public const TABLE = 'wall_types';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
    ];
}
