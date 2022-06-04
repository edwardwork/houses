<?php

namespace App\Models\Gas;

use App\Traits\HasManyHousesTrait;
use Carbon\Carbon;
use Database\Factories\Gas\GasFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static GasFactory factory(...$parameters)
 */
class Gas extends Model
{
    use HasFactory;
    use HasManyHousesTrait;

    public const TABLE = 'gases';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
    ];
}
