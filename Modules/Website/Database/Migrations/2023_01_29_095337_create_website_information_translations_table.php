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
        Schema::create('website_information_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_information_id')->references('id')->on('website_information');
            $table->foreignId('language_id')->references('id')->on('languages');
            $table->string('name');
            $table->timestamps();
            $table->unique(['website_information_id', 'language_id'], 'website_information_id_language_id_unique_app');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_information_translations');
    }
};
