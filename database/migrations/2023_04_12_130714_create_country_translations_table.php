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
        Schema::create('country_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('nationality', 50);
            $table->foreignId('country_id')->references('id')->on('countries');
            $table->foreignId('language_id')->references('id')->on('languages');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['country_id', 'language_id', 'deleted_at'], 'country_language_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_translations');
    }
};
