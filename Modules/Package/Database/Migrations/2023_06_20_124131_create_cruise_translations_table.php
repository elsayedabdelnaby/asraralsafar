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
        Schema::create('cruise_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->string('take_off_location');
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->unsignedBigInteger('cruise_id');
            $table->foreign('cruise_id')->references('id')->on('cruises');
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
        Schema::dropIfExists('cruise_translations');
    }
};
