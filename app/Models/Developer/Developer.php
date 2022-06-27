<?php

namespace App\Models\Developer;

use App\Enums\Developer\DeveloperEnum;
use App\Models\ResidentialComplex\ResidentialComplex;
use Carbon\Carbon;
use Database\Factories\Developer\DeveloperFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use League\Glide\Filesystem\FileNotFoundException;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property int id
 * @property string title
 * @property ?string description
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static DeveloperFactory factory(...$parameters)
 */
class Developer extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public const TABLE = 'developers';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
        'description',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(DeveloperEnum::LOGO)
            ->useDisk(config('filesystems.logo'));
    }

    /**
     * @throws InvalidManipulation
     * @throws FileNotFoundException
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion(DeveloperEnum::SMALL_CONVERSATION)
            ->width(349)
            ->height(262)
            ->sharpen(10)
            ->watermark(public_path('watermark.png'))
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->watermarkFit(Manipulations::FIT_CONTAIN)
            ->watermarkWidth(100, Manipulations::UNIT_PERCENT)
            ->nonOptimized()
            ->nonQueued();

        $this->addMediaConversion(DeveloperEnum::MEDIUM_CONVERSATION)
            ->width(749)
            ->height(562)
            ->sharpen(10)
            ->watermark(public_path('watermark.png'))
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->watermarkFit(Manipulations::FIT_CONTAIN)
            ->watermarkWidth(100, Manipulations::UNIT_PERCENT)
            ->nonOptimized()
            ->nonQueued();

        $this->addMediaConversion(DeveloperEnum::LARGE_CONVERSATION)
            ->width(1920)
            ->height(1440)
            ->sharpen(10)
            ->watermark(public_path('watermark.png'))
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->watermarkFit(Manipulations::FIT_CONTAIN)
            ->watermarkWidth(100, Manipulations::UNIT_PERCENT)
            ->nonOptimized()
            ->nonQueued();
    }

    public function residentialComplexes(): HasMany|ResidentialComplex
    {
        return $this->hasMany(ResidentialComplex::class);
    }
}
