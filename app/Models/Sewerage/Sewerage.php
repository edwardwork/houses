<?php

namespace App\Models\Sewerage;

use App\Traits\HasManyHousesTrait;
use Carbon\Carbon;
use Database\Factories\Sewerage\SewerageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static SewerageFactory factory(...$parameters)
 */
class Sewerage extends Model
{
    use HasFactory;
    use HasManyHousesTrait;

    public const TABLE = 'sewerages';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
    ];
}
