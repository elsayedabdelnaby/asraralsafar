<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('take_off_station_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('takeoff_station_id');
            $table->foreign('takeoff_station_id')->references('id')->on('take_off_stations')->cascadeOnDelete();
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('arrival_station_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('arrival_station_id');
            $table->foreign('arrival_station_id')->references('id')->on('arrival_stations')->cascadeOnDelete();
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages')->cascadeOnDelete();
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
        Schema::dropIfExists('take_off_station_translations');
        Schema::dropIfExists('arrival_station_translations');
    }
};
