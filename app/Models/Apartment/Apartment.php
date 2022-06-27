<?php

namespace App\Models\Apartment;

use App\Enums\Apartment\ApartmentEnum;
use App\Models\BathroomType\BathroomType;
use App\Models\ColdWaterSupply\ColdWaterSupply;
use App\Models\Electricity\Electricity;
use App\Models\Gas\Gas;
use App\Models\HotWaterSupply\HotWaterSupply;
use App\Models\HouseType\HouseType;
use App\Models\Microdistrict\Microdistrict;
use App\Models\Outbuilding\Outbuilding;
use App\Models\Overlap\Overlap;
use App\Models\Repair\Repair;
use App\Models\ResidentialHouse\ResidentialHouse;
use App\Models\Sewerage\Sewerage;
use App\Models\Street\Street;
use App\Models\WallType\WallType;
use App\Models\Warm\Warm;
use Carbon\Carbon;
use Database\Factories\Apartment\ApartmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
 * @property int price
 * @property int house_type_id
 * @property int floor
 * @property int room_count
 * @property double common_square
 * @property double kitchen_square
 * @property int outbuilding_id
 * @property int bathroom_type_id
 * @property int repair_id
 * @property int residential_house_id
 * @property int entrance
 *
 * @property-read ?Microdistrict microdistrict
 * @property-read ?Street street
 * @property-read ?WallType wallType
 * @property-read ?Overlap overlap
 * @property-read ?Outbuilding outbuilding
 * @property-read ?ColdWaterSupply coldWaterSupply
 * @property-read ?HotWaterSupply hotWaterSupply
 * @property-read ?Sewerage sewerage
 * @property-read ?Gas gas
 * @property-read ?Electricity electricity
 * @property-read ?Warm warm
 * @property-read ?HouseType houseType
 * @property-read ?BathroomType bathroomType
 * @property-read ?Repair repair
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static ApartmentFactory factory(...$parameters)
 */
class Apartment extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public const TABLE = 'apartments';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
        'description',
        'price',
        'house_type_id',
        'floor',
        'room_count',
        'common_square',
        'kitchen_square',
        'outbuilding_id',
        'bathroom_type_id',
        'repair_id',
        'residential_house_id',
        'entrance',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(ApartmentEnum::PLANNING)
            ->useDisk(config('filesystems.apartment'));
    }

    /**
     * @throws InvalidManipulation
     * @throws FileNotFoundException
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion(ApartmentEnum::SMALL_CONVERSATION)
            ->width(349)
            ->height(262)
            ->sharpen(10)
            ->watermark(public_path('watermark.png'))
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->watermarkFit(Manipulations::FIT_CONTAIN)
            ->watermarkWidth(100, Manipulations::UNIT_PERCENT)
            ->nonOptimized()
            ->nonQueued();

        $this->addMediaConversion(ApartmentEnum::MEDIUM_CONVERSATION)
            ->width(749)
            ->height(562)
            ->sharpen(10)
            ->watermark(public_path('watermark.png'))
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->watermarkFit(Manipulations::FIT_CONTAIN)
            ->watermarkWidth(100, Manipulations::UNIT_PERCENT)
            ->nonOptimized()
            ->nonQueued();

        $this->addMediaConversion(ApartmentEnum::LARGE_CONVERSATION)
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

    public function outbuilding(): BelongsTo|Outbuilding
    {
        return $this->belongsTo(Outbuilding::class);
    }

    public function houseType(): BelongsTo|HouseType
    {
        return $this->belongsTo(HouseType::class);
    }

    public function bathroomType(): BelongsTo|BathroomType
    {
        return $this->belongsTo(BathroomType::class);
    }

    public function repair(): BelongsTo|Repair
    {
        return $this->belongsTo(Repair::class);
    }

    public function residentialHouse(): BelongsTo|ResidentialHouse
    {
        return $this->belongsTo(ResidentialHouse::class);
    }

    public function getPriceAsText(): string
    {
        return "$this->price руб.";
    }
}
