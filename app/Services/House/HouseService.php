<?php

namespace App\Services\House;

use App\Dto\GoogleSheet\GoogleSheetDto;
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
use App\Services\Dadata\DadataService;
use App\Services\GoogleSheet\GoogleSheetService;
use JetBrains\PhpStorm\Pure;

class HouseService
{
    public function __construct(
        protected DadataService $dadataService,
        protected GoogleSheetService $googleSheetService
    ) {
    }

    #[Pure] public function extractAddressForDadataService(GoogleSheetDto $dto): ?string
    {
        $city = 'Сокол';
        $region = 'Вологодская область';
        $streetName = $dto->getStreetTitle();
        $number = $dto->getNumber();

        $address = null;

        if ($streetName && $number) {
            $address = "город $city, $region, улица $streetName, дом $number";
        }

        return $address;
    }

    public function importFromGoogleSheet(): void
    {
        $data = $this->googleSheetService->readSheet()?->getValues();
        $parsedData = $this->googleSheetService->parseData($data);

        foreach ($parsedData as $datum) {
            $microdistrict = Microdistrict::query()->firstOrCreate(['title' => $datum->getMicrodistrictTitle()]);
            $street = Street::query()->firstOrCreate(['title' => $datum->getStreetTitle()]);
            $wallType = WallType::query()->firstOrCreate(['title' => $datum->getWallTypeTitle()]);
            $overlap = Overlap::query()->firstOrCreate(['title' => $datum->getOverlapTitle()]);
            $outbuilding = Outbuilding::query()->firstOrCreate(['title' => $datum->getOutbuildingTitle()]);
            $coldWaterSupply = ColdWaterSupply::query()->firstOrCreate(['title' => $datum->getColdWaterSupplyTitle()]);
            $hotWaterSupply = HotWaterSupply::query()->firstOrCreate(['title' => $datum->getHotWaterSupplyTitle()]);
            $sewerage = Sewerage::query()->firstOrCreate(['title' => $datum->getSewerageTitle()]);
            $gas = Gas::query()->firstOrCreate(['title' => $datum->getGasTitle()]);
            $electricity = Electricity::query()->firstOrCreate(['title' => $datum->getElectricityTitle()]);
            $warm = Warm::query()->firstOrCreate(['title' => $datum->getWarmTitle()]);
            $houseType = HouseType::query()->firstOrCreate(['title' => $datum->getHouseTypeTitle()]);

            $addressForDadata = $this->extractAddressForDadataService($datum);
            $fiasCode = $this->dadataService->getFiasCodeForAddress($addressForDadata);

            House::query()
                ->firstOrCreate(
                    [
                        'fias_code' => $fiasCode,
                        'microdistrict_id' => $microdistrict->id,
                        'zone' => $datum->getZone(),
                        'street_id' => $street->id,
                        'number' => $datum->getNumber(),
                        'year' => $datum->getYear(),
                        'wall_type_id' => $wallType->id,
                        'overlap_id' => $overlap->id,
                        'outbuilding_id' => $outbuilding->id,
                        'floor' => $datum->getFloor(),
                        'entrance' => $datum->getEntrance(),
                        'cold_water_supply_id' => $coldWaterSupply->id,
                        'hot_water_supply_id' => $hotWaterSupply->id,
                        'sewerage_id' => $sewerage->id,
                        'gas_id' => $gas->id,
                        'electricity_id' => $electricity->id,
                        'warm_id' => $warm->id,
                        'house_type_id' => $houseType->id,
                    ]
                );
        }
    }
}