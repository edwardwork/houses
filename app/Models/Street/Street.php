<?php

namespace App\Models\Street;

use App\Traits\HasManyHousesTrait;
use Carbon\Carbon;
use Database\Factories\Street\StreetFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static StreetFactory factory(...$parameters)
 */
class Street extends Model
{
    use HasFactory;
    use HasManyHousesTrait;

    public const TABLE = 'streets';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
    ];
}
