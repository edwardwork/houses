<?php

namespace Tests\Feature;

use App\Dto\GoogleSheet\GoogleSheetDto;
use App\Services\GoogleSheet\GoogleSheetService;
use Tests\TestCase;

class GoogleSheetServiceTest extends TestCase
{
    public function test_function_parse_data_correctly_works(): void
    {
        $service = app(GoogleSheetService::class);
        $payload = [
            [
                "Локация",
                "",
                "",
                "",
                "Характеристики дома",
                "",
                "",
                "",
                "",
                "",
                "Коммуникации",
                "",
                "",
                "",
                "",
                "",
                "Фонд",
                "Количество",
            ],
            [
                "Мкр",
                "Зона",
                "Улица",
                "№ дома",
                "Г.П.",
                "Тип",
                "Перекр.",
                "Б/Л",
                "Эт.",
                "Подъезд",
                "ХВС",
                "ГВС",
                "Канал",
                "Газ",
                "Электр",
                "Тепло",
                "Тип дома",
                "квартир в доме",
            ],
            [
                "Центр",
                "1",
                "Советская ",
                "51",
                "1975",
                "кирпич",
                "бетон",
                "",
                "5",
                "6",
                "центр",
                "нет",
                "центр",
                "центр",
                "центр",
                "центр",
                "брежневка",
              ],
            [
                   "Центр",
                "1",
                "Советская ",
                "59",
                "1982",
                "кирпич",
                "бетон",
                "",
                "5",
                "5",
                "центр",
                "Открытая с отбором сетевой воды на горячее водоснабжение из тепловой сети",
                "центр",
                "центр",
                "центр",
                "центр",
                "новостройка",
              ],
            [
                "Центр",
                "1",
                "Советская ",
                "65",
                "1984",
                "кирпич",
                "бетон",
                "",
                "5",
                "6",
                "центр",
                "Открытая с отбором сетевой воды на горячее водоснабжение из тепловой сети",
                "центр",
                "центр",
                "центр",
                "центр",
                "новостройка",
              ]
        ];

        $parsedData = $service->parseData($payload);

        $this->assertCount(3, $parsedData);
        foreach ($parsedData as $parsedDatum) {
            $this->assertInstanceOf(GoogleSheetDto::class, $parsedDatum);
        }
    }
}