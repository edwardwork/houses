<?php

namespace App\Models\House;

use App\Enums\House\HouseEnum;
use App\Models\ColdWaterSupply\ColdWaterSupply;
use App\Models\Electricity\Electricity;
use App\Models\Gas\Gas;
use App\Models\HotWaterSupply\HotWaterSupply;
use App\Models\HouseType\HouseType;
use App\Models\Microdistrict\Microdistrict;
use App\Models\Outbuilding\Outbuilding;
use App\Models\Overlap\Overlap;
use App\Models\Sewerage\Sewerage;
use App\Models\Street\Street;
use App\Models\WallType\WallType;
use App\Models\Warm\Warm;
use Carbon\Carbon;
use Database\Factories\House\HouseFactory;
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
 * @property ?string fias_code
 * @property ?int microdistrict_id
 * @property ?int zone
 * @property ?int street_id
 * @property ?string number
 * @property ?int year
 * @property ?int wall_type_id
 * @property ?int overlap_id
 * @property ?int outbuilding_id
 * @property ?int floor
 * @property ?int entrance
 * @property ?int cold_water_supply_id
 * @property ?int hot_water_supply_id
 * @property ?int sewerage_id
 * @property ?int gas_id
 * @property ?int electricity_id
 * @property ?int warm_id
 * @property ?int house_type_id
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
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @property string address
 *
 * @method static HouseFactory factory(...$parameters)
 */
class House extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public const TABLE = 'houses';

    protected $table = self::TABLE;

    protected $fillable = [
        'fias_code',
        'microdistrict_id',
        'zone',
        'street_id',
        'number',
        'year',
        'wall_type_id',
        'overlap_id',
        'outbuilding_id',
        'floor',
        'entrance',
        'cold_water_supply_id',
        'hot_water_supply_id',
        'sewerage_id',
        'gas_id',
        'electricity_id',
        'warm_id',
        'house_type_id',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(HouseEnum::FACADES)
            ->useDisk(config('filesystems.house'));

        $this->addMediaCollection(HouseEnum::TERRITORY)
            ->useDisk(config('filesystems.house'));

        $this->addMediaCollection(HouseEnum::ENTRANCE)
            ->useDisk(config('filesystems.house'));

        $this->addMediaCollection(HouseEnum::ENTRANCE_ENTER)
            ->useDisk(config('filesystems.house'));
    }

    /**
     * @throws InvalidManipulation
     * @throws FileNotFoundException
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion(HouseEnum::SMALL_CONVERSATION)
            ->width(349)
            ->height(262)
            ->sharpen(10)
            ->watermark(public_path('watermark.png'))
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->watermarkFit(Manipulations::FIT_CONTAIN)
            ->watermarkWidth(100, Manipulations::UNIT_PERCENT)
            ->nonOptimized()
            ->nonQueued();

        $this->addMediaConversion(HouseEnum::MEDIUM_CONVERSATION)
            ->width(749)
            ->height(562)
            ->sharpen(10)
            ->watermark(public_path('watermark.png'))
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->watermarkFit(Manipulations::FIT_CONTAIN)
            ->watermarkWidth(100, Manipulations::UNIT_PERCENT)
            ->nonOptimized()
            ->nonQueued();

        $this->addMediaConversion(HouseEnum::LARGE_CONVERSATION)
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

    public function microdistrict(): BelongsTo|Microdistrict
    {
        return $this->belongsTo(Microdistrict::class);
    }

    public function street(): BelongsTo|Street
    {
        return $this->belongsTo(Street::class);
    }

    public function wallType(): BelongsTo|WallType
    {
        return $this->belongsTo(WallType::class);
    }

    public function overlap(): BelongsTo|Overlap
    {
        return $this->belongsTo(Overlap::class);
    }

    public function outbuilding(): BelongsTo|Outbuilding
    {
        return $this->belongsTo(Outbuilding::class);
    }

    public function coldWaterSupply(): BelongsTo|ColdWaterSupply
    {
        return $this->belongsTo(ColdWaterSupply::class);
    }

    public function hotWaterSupply(): BelongsTo|HotWaterSupply
    {
        return $this->belongsTo(HotWaterSupply::class);
    }

    public function sewerage(): BelongsTo|Sewerage
    {
        return $this->belongsTo(Sewerage::class);
    }

    public function gas(): BelongsTo|Gas
    {
        return $this->belongsTo(Gas::class);
    }

    public function electricity(): BelongsTo|Electricity
    {
        return $this->belongsTo(Electricity::class);
    }

    public function warm(): BelongsTo|Warm
    {
        return $this->belongsTo(Warm::class);
    }

    public function houseType(): BelongsTo|HouseType
    {
        return $this->belongsTo(HouseType::class);
    }

    public function makeFullAddress(): string
    {
        $microdistrict = $this->microdistrict?->title;
        $streetName = $this->street?->title;
        $number = $this->number;

        return "микрорайон $microdistrict, улица $streetName, дом $number";
    }

    protected static function booted()
    {
        static::creating(static function (House $house) {
            $house->address = $house->makeFullAddress();
        });

        static::updating(static function (House $house) {
            $house->address = $house->makeFullAddress();
        });
    }
}
