<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();

            $table->string('fias_code')
                ->nullable()
                ->comment('ФИАС код');

            $table->unsignedInteger('microdistrict_id')
                ->nullable()
                ->comment('Микрорайон');

            $table->integer('zone')
                ->nullable()
                ->comment('Зона');

            $table->unsignedInteger('street_id')
                ->nullable()
                ->comment('Улица');

            $table->string('number')
                ->nullable()
                ->comment('Номер дома');

            $table->unsignedInteger('year')
                ->nullable()
                ->comment('Год постройки');

            $table->unsignedInteger('wall_type_id')
                ->nullable()
                ->comment('Тип материала дома');

            $table->unsignedInteger('overlap_id')
                ->nullable()
                ->comment('Перекрытие');

            $table->unsignedInteger('outbuilding_id')
                ->nullable()
                ->comment('Пристройка');

            $table->unsignedInteger('floor')
                ->nullable()
                ->comment('Этаж');

            $table->unsignedInteger('entrance')
                ->nullable()
                ->comment('Подъезд');

            $table->unsignedInteger('cold_water_supply_id')
                ->nullable()
                ->comment('ХВС');

            $table->unsignedInteger('hot_water_supply_id')
                ->nullable()
                ->comment('ГВС');

            $table->unsignedInteger('sewerage_id')
                ->nullable()
                ->comment('Канализация');

            $table->unsignedInteger('gas_id')
                ->nullable()
                ->comment('Газ');

            $table->unsignedInteger('electricity_id')
                ->nullable()
                ->comment('Электричество');

            $table->unsignedInteger('warm_id')
                ->nullable()
                ->comment('Тепло');

            $table->unsignedInteger('house_type_id')
                ->nullable()
                ->comment('Тип дома');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
};
