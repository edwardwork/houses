<?php

namespace App\Providers;

use App\Models\ColdWaterSupply\ColdWaterSupply;
use App\Models\Electricity\Electricity;
use App\Models\Gas\Gas;
use App\Models\HotWaterSupply\HotWaterSupply;
use App\Models\House\House;
use App\Models\HouseType\HouseType;
use App\Models\Microdistrict\Microdistrict;
use App\Models\Outbuilding\Outbuilding;
use App\Models\Overlap\Overlap;
use App\Models\Sewerage\Sewerage;
use App\Models\Street\Street;
use App\Models\WallType\WallType;
use App\Models\Warm\Warm;
use App\Policies\ColdWaterSupply\ColdWaterSupplyPolicy;
use App\Policies\Electricity\ElectricityPolicy;
use App\Policies\Gas\GasPolicy;
use App\Policies\HotWaterSupply\HotWaterSupplyPolicy;
use App\Policies\House\HousePolicy;
use App\Policies\HouseType\HouseTypePolicy;
use App\Policies\Media\MediaPolicy;
use App\Policies\Microdistrict\MicrodistrictPolicy;
use App\Policies\Outbuilding\OutbuildingPolicy;
use App\Policies\Overlap\OverlapPolicy;
use App\Policies\Sewerage\SeweragePolicy;
use App\Policies\Street\StreetPolicy;
use App\Policies\WallType\WallTypePolicy;
use App\Policies\Warm\WarmPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Media::class => MediaPolicy::class,
        ColdWaterSupply::class => ColdWaterSupplyPolicy::class,
        Electricity::class => ElectricityPolicy::class,
        Gas::class => GasPolicy::class,
        HotWaterSupply::class => HotWaterSupplyPolicy::class,
        House::class => HousePolicy::class,
        HouseType::class => HouseTypePolicy::class,
        Microdistrict::class => MicrodistrictPolicy::class,
        Outbuilding::class => OutbuildingPolicy::class,
        Overlap::class => OverlapPolicy::class,
        Sewerage::class => SeweragePolicy::class,
        Street::class => StreetPolicy::class,
        WallType::class => WallTypePolicy::class,
        Warm::class => WarmPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
    }
}
