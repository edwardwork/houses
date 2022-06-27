<?php

namespace App\Models\Repair;

use Carbon\Carbon;
use Database\Factories\Repair\RepairFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static RepairFactory factory(...$parameters)
 */
class Repair extends Model
{
    use HasFactory;

    public const TABLE = 'repairs';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
    ];
}
