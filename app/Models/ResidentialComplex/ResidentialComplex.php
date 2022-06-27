<?php

namespace App\Models\ResidentialComplex;

use App\Enums\ResidentialComplex\ResidentialComplexEnum;
use App\Models\Apartment\Apartment;
use App\Models\Developer\Developer;
use App\Models\ResidentialHouse\ResidentialHouse;
use Carbon\Carbon;
use Database\Factories\ResidentialComplex\ResidentialComplexFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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
 * @property string address
 * @property int built_year
 * @property ?double lat
 * @property ?double lng
 * @property int developer_id
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @see ResidentialComplex::getPriceAttribute()
 * @property int price
 *
 * @see ResidentialComplex::developer()
 * @property Developer developer
 *
 * @method static ResidentialComplexFactory factory(...$parameters)
 */
class ResidentialComplex extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public const TABLE = 'residential_complexes';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
        'description',
        'address',
        'lat',
        'lng',
        'developer_id',
        'price',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(ResidentialComplexEnum::GENERAL_PLAN)
            ->useDisk(config('filesystems.residential_complex'));

        $this->addMediaCollection(ResidentialComplexEnum::PHOTOS_RESIDENTIAL_COMPLEX)
            ->useDisk(config('filesystems.residential_complex'));

        $this->addMediaCollection(ResidentialComplexEnum::VIDEOS_RESIDENTIAL_COMPLEX)
            ->useDisk(config('filesystems.residential_complex'));
    }

    /**
     * @throws InvalidManipulation
     * @throws FileNotFoundException
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion(ResidentialComplexEnum::SMALL_CONVERSATION)
            ->width(349)
            ->height(262)
            ->sharpen(10)
            ->watermark(public_path('watermark.png'))
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->watermarkFit(Manipulations::FIT_CONTAIN)
            ->watermarkWidth(100, Manipulations::UNIT_PERCENT)
            ->nonOptimized()
            ->nonQueued();

        $this->addMediaConversion(ResidentialComplexEnum::MEDIUM_CONVERSATION)
            ->width(749)
            ->height(562)
            ->sharpen(10)
            ->watermark(public_path('watermark.png'))
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->watermarkFit(Manipulations::FIT_CONTAIN)
            ->watermarkWidth(100, Manipulations::UNIT_PERCENT)
            ->nonOptimized()
            ->nonQueued();

        $this->addMediaConversion(ResidentialComplexEnum::LARGE_CONVERSATION)
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

    public function developer(): BelongsTo|Developer
    {
        return $this->belongsTo(Developer::class);
    }

    public function residentialHouses(): HasMany|ResidentialHouse
    {
        return $this->hasMany(ResidentialHouse::class);
    }

    public function apartments(): HasManyThrough|Apartment
    {
        return $this->hasManyThrough(Apartment::class, ResidentialHouse::class);
    }

    public function getPriceAsText(): string
    {
        return "от $this->price руб.";
    }

    public function scopeContainsRoom(Builder $query): Builder
    {
        $functionArguments = func_get_args();
        unset($functionArguments[0]);

        foreach ($functionArguments as $key => $roomCount) {
            $query->orWhereHas('apartments', function (Builder $builder) use ($roomCount) {
                $builder->where('room_count', $roomCount);
            });
        }
        return $query;
    }

    public function scopePriceBetween(Builder $query, $min, $max): Builder
    {
        return $query->when(!empty($min), function (Builder $builder) use ($min) {
            $builder->where('price', '>=', $min);
        })->when(!empty($max), function (Builder $builder) use ($max) {
            $builder->where('price', '<=', $max);
        });
    }
}
