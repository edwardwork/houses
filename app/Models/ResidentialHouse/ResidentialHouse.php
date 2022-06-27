<?php

namespace App\Models\ResidentialHouse;

use App\Enums\ResidentialHouse\ResidentialHouseEnum;
use App\Models\Apartment\Apartment;
use App\Models\HouseType\HouseType;
use App\Models\Microdistrict\Microdistrict;
use App\Models\ResidentialComplex\ResidentialComplex;
use Carbon\Carbon;
use Database\Factories\ResidentialComplex\ResidentialComplexFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
 * @property integer price
 * @property ?string description
 * @property string address
 * @property int microdistrict_id
 * @property ?double lat
 * @property ?double lng
 * @property int residential_complex_id
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static ResidentialComplexFactory factory(...$parameters)
 */
class ResidentialHouse extends Model implements HasMedia
{
    use HasFactory;

    use InteractsWithMedia;

    public const TABLE = 'residential_houses';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
        'description',
        'address',
        'microdistrict_id',
        'lat',
        'lng',
        'residential_complex_id',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(ResidentialHouseEnum::PHOTO_CONSTRUCTION_PROGRESS)
            ->useDisk(config('filesystems.residential_house'));
    }

    /**
     * @throws InvalidManipulation
     * @throws FileNotFoundException
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion(ResidentialHouseEnum::SMALL_CONVERSATION)
            ->width(349)
            ->height(262)
            ->sharpen(10)
            ->watermark(public_path('watermark.png'))
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->watermarkFit(Manipulations::FIT_CONTAIN)
            ->watermarkWidth(100, Manipulations::UNIT_PERCENT)
            ->nonOptimized()
            ->nonQueued();

        $this->addMediaConversion(ResidentialHouseEnum::MEDIUM_CONVERSATION)
            ->width(749)
            ->height(562)
            ->sharpen(10)
            ->watermark(public_path('watermark.png'))
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->watermarkFit(Manipulations::FIT_CONTAIN)
            ->watermarkWidth(100, Manipulations::UNIT_PERCENT)
            ->nonOptimized()
            ->nonQueued();

        $this->addMediaConversion(ResidentialHouseEnum::LARGE_CONVERSATION)
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

    public function apartments(): HasMany|Apartment
    {
        return $this->hasMany(Apartment::class);
    }

    public function microdistrict(): BelongsTo|Microdistrict
    {
        return $this->belongsTo(Microdistrict::class);
    }

    public function residentialComplex(): BelongsTo|ResidentialComplex
    {
        return $this->belongsTo(ResidentialComplex::class);
    }

    public function houseType(): BelongsTo|HouseType
    {
        return $this->belongsTo(HouseType::class);
    }

    public function getPriceAsText(): string
    {
        return "от $this->price руб.";
    }
}
