<?php

namespace Tests\Feature;

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
use App\Models\User;
use App\Models\WallType\WallType;
use App\Models\Warm\Warm;
use Tests\TestCase;

class ApiCorrectWorkTest extends TestCase
{
    public function test_guest_cant_get_house_via_api(): void
    {
        $microdistrict = Microdistrict::factory()->create();
        $street = Street::factory()->create();
        $wallType = WallType::factory()->create();
        $overlap = Overlap::factory()->create();
        $outbuilding = Outbuilding::factory()->create();
        $coldWaterSupply = ColdWaterSupply::factory()->create();
        $hotWaterSupply = HotWaterSupply::factory()->create();
        $sewerage = Sewerage::factory()->create();
        $gas = Gas::factory()->create();
        $electricity = Electricity::factory()->create();
        $warm = Warm::factory()->create();
        $houseType = HouseType::factory()->create();
        $fiasCode = 'fiasCode1';

        House::factory()
            ->for($microdistrict)
            ->for($street)
            ->for($wallType)
            ->for($overlap)
            ->for($outbuilding)
            ->for($coldWaterSupply)
            ->for($hotWaterSupply)
            ->for($sewerage)
            ->for($gas)
            ->for($electricity)
            ->for($warm)
            ->for($houseType)
            ->create(
                [
                    'fias_code' => $fiasCode
                ]
            );

        $this->get('api/house/' . $fiasCode, ['accept' => 'application/json'])
            ->assertUnauthorized();
    }

    public function test_user_can_get_house_via_api(): void
    {
        $this->actingAs(User::factory()->create());

        $microdistrict = Microdistrict::factory()->create();
        $street = Street::factory()->create();
        $wallType = WallType::factory()->create();
        $overlap = Overlap::factory()->create();
        $outbuilding = Outbuilding::factory()->create();
        $coldWaterSupply = ColdWaterSupply::factory()->create();
        $hotWaterSupply = HotWaterSupply::factory()->create();
        $sewerage = Sewerage::factory()->create();
        $gas = Gas::factory()->create();
        $electricity = Electricity::factory()->create();
        $warm = Warm::factory()->create();
        $houseType = HouseType::factory()->create();
        $fiasCode = 'fiasCode1';
        $year = '1975';
        $floor = '3';

        $house = House::factory()
            ->for($microdistrict)
            ->for($street)
            ->for($wallType)
            ->for($overlap)
            ->for($outbuilding)
            ->for($coldWaterSupply)
            ->for($hotWaterSupply)
            ->for($sewerage)
            ->for($gas)
            ->for($electricity)
            ->for($warm)
            ->for($houseType)
            ->create(
                [
                    'fias_code' => $fiasCode,
                    'year' => $year,
                    'floor' => $floor
                ]
            );

        $this->get('api/house/' . $fiasCode, ['accept' => 'application/json'])
            ->assertJsonStructure(
                [
                    'data' => [
                        'year',
                        'floor',
                        'house_type',
                        'wall_type',
                        'full_address',
                    ]
                ]
            )
            ->assertOk();
    }
}