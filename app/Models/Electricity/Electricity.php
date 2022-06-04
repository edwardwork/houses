<?php

namespace App\Models\Electricity;

use App\Traits\HasManyHousesTrait;
use Carbon\Carbon;
use Database\Factories\Electricity\ElectricityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static ElectricityFactory factory(...$parameters)
 */
class Electricity extends Model
{
    use HasFactory;
    use HasManyHousesTrait;

    public const TABLE = 'electricities';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
    ];
}
