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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['going_only', 'going_and_return']);
            $table->enum('category', ['economic', 'business_men']);
            $table->date('traveling_date');
            $table->date('return_date');
            $table->double('price');
            $table->string('image');
            $table->string('destination_slug');
            $table->string('arrival_time');
            $table->unsignedBigInteger('arrival_station_id');
            $table->foreign('arrival_station_id')->references('id')->on('arrival_stations')->cascadeOnDelete();
            $table->unsignedBigInteger('takeoff_station_id');
            $table->foreign('takeoff_station_id')->references('id')->on('take_off_stations')->cascadeOnDelete();
            $table->unsignedBigInteger('air_lines_id');
            $table->foreign('air_lines_id')->references('id')->on('air_lines')->cascadeOnDelete();
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
        Schema::dropIfExists('flights');
    }
};
