<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('price')->default(0);
            $table->integer('house_type_id');
            $table->integer('floor')->default(1);
            $table->integer('room_count')->default(0);
            $table->double('common_square')->default(0);
            $table->double('kitchen_square')->default(0);
            $table->integer('outbuilding_id');
            $table->integer('bathroom_type_id');
            $table->integer('repair_id');
            $table->integer('residential_house_id');
            $table->integer('entrance');
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
        Schema::dropIfExists('apartments');
    }
};
