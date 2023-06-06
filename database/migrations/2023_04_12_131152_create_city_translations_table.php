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
        Schema::create('city_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->foreignId('city_id')->references('id')->on('cities');
            $table->foreignId('language_id')->references('id')->on('languages');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['city_id', 'language_id', 'deleted_at'], 'city_language_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city_translations');
    }
};
