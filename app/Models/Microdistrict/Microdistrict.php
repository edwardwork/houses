<?php

namespace App\Models\Microdistrict;

use App\Traits\HasManyHousesTrait;
use Carbon\Carbon;
use Database\Factories\Microdistrict\MicrodistrictFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static MicrodistrictFactory factory(...$parameters)
 */
class Microdistrict extends Model
{
    use HasFactory;
    use HasManyHousesTrait;

    public const TABLE = 'microdistricts';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
    ];
}