<?php

namespace App\Models\Overlap;

use App\Traits\HasManyHousesTrait;
use Carbon\Carbon;
use Database\Factories\Overlap\OverlapFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static OverlapFactory factory(...$parameters)
 */
class Overlap extends Model
{
    use HasFactory;
    use HasManyHousesTrait;

    public const TABLE = 'overlaps';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
    ];
}
