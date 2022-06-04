<?php

namespace App\Models\Warm;

use App\Traits\HasManyHousesTrait;
use Carbon\Carbon;
use Database\Factories\Warm\WarmFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static WarmFactory factory(...$parameters)
 */
class Warm extends Model
{
    use HasFactory;
    use HasManyHousesTrait;

    public const TABLE = 'warms';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
    ];
}
