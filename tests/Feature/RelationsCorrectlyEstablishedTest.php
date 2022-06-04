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
use App\Models\WallType\WallType;
use App\Models\Warm\Warm;
use Tests\TestCase;

class RelationsCorrectlyEstablishedTest extends TestCase
{
    public function test_relations_correctly_established(): void
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
            ->create();

        $this->assertNotEmpty($house->microdistrict);
        $this->assertNotEmpty($house->street);
        $this->assertNotEmpty($house->wallType);
        $this->assertNotEmpty($house->overlap);
        $this->assertNotEmpty($house->outbuilding);
        $this->assertNotEmpty($house->coldWaterSupply);
        $this->assertNotEmpty($house->hotWaterSupply);
        $this->assertNotEmpty($house->sewerage);
        $this->assertNotEmpty($house->gas);
        $this->assertNotEmpty($house->electricity);
        $this->assertNotEmpty($house->warm);
        $this->assertNotEmpty($house->houseType);
    }
}