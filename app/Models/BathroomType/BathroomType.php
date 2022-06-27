<?php

namespace App\Models\BathroomType;

use Carbon\Carbon;
use Database\Factories\BathroomType\BathroomTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static BathroomTypeFactory factory(...$parameters)
 */
class BathroomType extends Model
{
    use HasFactory;

    public const TABLE = 'bathroom_types';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
    ];
}
