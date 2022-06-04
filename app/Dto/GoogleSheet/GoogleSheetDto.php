<?php

namespace App\Dto\GoogleSheet;

class GoogleSheetDto
{
    protected ?string $microdistrictTitle;
    protected ?int $zone;
    protected ?string $streetTitle;
    protected ?string $number;
    protected ?int $year;
    protected ?string $wallTypeTitle;
    protected ?string $overlapTitle;
    protected ?string $outbuildingTitle;
    protected ?int $floor;
    protected ?int $entrance;
    protected ?string $coldWaterSupplyTitle;
    protected ?string $hotWaterSupplyTitle;
    protected ?string $sewerageTitle;
    protected ?string $gasTitle;
    protected ?string $electricityTitle;
    protected ?string $warmTitle;
    protected ?string $houseTypeTitle;

    public static function buildByArgs(array $args = []): static
    {
        $instance = new static();
        
        $instance->setMicrodistrictTitle(data_get($args, 0));
        $instance->setZone(data_get($args, 1));
        $instance->setStreetTitle(data_get($args, 2));
        $instance->setNumber(data_get($args, 3));
        $instance->setYear(data_get($args, 4));
        $instance->setWallTypeTitle(data_get($args, 5));
        $instance->setOverlapTitle(data_get($args, 6));
        $instance->setOutbuildingTitle(data_get($args, 7));
        $instance->setFloor(data_get($args, 8));
        $instance->setEntrance(data_get($args, 9));
        $instance->setColdWaterSupplyTitle(data_get($args, 10));
        $instance->setHotWaterSupplyTitle(data_get($args, 11));
        $instance->setSewerageTitle(data_get($args, 12));
        $instance->setGasTitle(data_get($args, 13));
        $instance->setElectricityTitle(data_get($args, 14));
        $instance->setWarmTitle(data_get($args, 15));
        $instance->setHouseTypeTitle(data_get($args, 16));

        return $instance;
    }

    public function getMicrodistrictTitle(): ?string
    {
        return $this->microdistrictTitle;
    }

    protected function setMicrodistrictTitle(?string $microdistrictTitle): void
    {
        $this->microdistrictTitle = trim($microdistrictTitle);
    }

    public function getZone(): ?int
    {
        return $this->zone;
    }

    protected function setZone(?string $zone): void
    {
        $this->zone = $zone ? (int)$zone : null;
    }

    public function getStreetTitle(): ?string
    {
        return $this->streetTitle;
    }

    protected function setStreetTitle(?string $streetTitle): void
    {
        $this->streetTitle = trim($streetTitle);
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    protected function setNumber(?string $number): void
    {
        $this->number = $number;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    protected function setYear(?string $year): void
    {
        $this->year = $year ? (int)$year : null;
    }

    public function getWallTypeTitle(): ?string
    {
        return $this->wallTypeTitle;
    }

    protected function setWallTypeTitle(?string $wallTypeTitle): void
    {
        $this->wallTypeTitle = trim($wallTypeTitle);
    }

    public function getOverlapTitle(): ?string
    {
        return $this->overlapTitle;
    }

    protected function setOverlapTitle(?string $overlapTitle): void
    {
        $this->overlapTitle = trim($overlapTitle);
    }

    public function getOutbuildingTitle(): ?string
    {
        return $this->outbuildingTitle;
    }

    protected function setOutbuildingTitle(?string $outbuildingTitle): void
    {
        $this->outbuildingTitle = trim($outbuildingTitle);
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    protected function setFloor(?string $floor): void
    {
        $this->floor = $floor ? (int)$floor : null;
    }

    public function getEntrance(): ?int
    {
        return $this->entrance;
    }

    protected function setEntrance(?string $entrance): void
    {
        $this->entrance = $entrance ? (int)$entrance : null;
    }

    public function getColdWaterSupplyTitle(): ?string
    {
        return $this->coldWaterSupplyTitle;
    }

    protected function setColdWaterSupplyTitle(?string $coldWaterSupplyTitle): void
    {
        $this->coldWaterSupplyTitle = trim($coldWaterSupplyTitle);
    }

    public function getHotWaterSupplyTitle(): ?string
    {
        return $this->hotWaterSupplyTitle;
    }

    protected function setHotWaterSupplyTitle(?string $hotWaterSupplyTitle): void
    {
        $this->hotWaterSupplyTitle = trim($hotWaterSupplyTitle);
    }

    public function getSewerageTitle(): ?string
    {
        return $this->sewerageTitle;
    }

    protected function setSewerageTitle(?string $sewerageTitle): void
    {
        $this->sewerageTitle = trim($sewerageTitle);
    }

    public function getGasTitle(): ?string
    {
        return $this->gasTitle;
    }

    protected function setGasTitle(?string $gasTitle): void
    {
        $this->gasTitle = trim($gasTitle);
    }

    public function getElectricityTitle(): ?string
    {
        return $this->electricityTitle;
    }

    protected function setElectricityTitle(?string $electricityTitle): void
    {
        $this->electricityTitle = trim($electricityTitle);
    }

    public function getWarmTitle(): ?string
    {
        return $this->warmTitle;
    }

    protected function setWarmTitle(?string $warmTitle): void
    {
        $this->warmTitle = trim($warmTitle);
    }

    public function getHouseTypeTitle(): ?string
    {
        return $this->houseTypeTitle;
    }

    protected function setHouseTypeTitle(?string $houseTypeTitle): void
    {
        $this->houseTypeTitle = trim($houseTypeTitle);
    }
}