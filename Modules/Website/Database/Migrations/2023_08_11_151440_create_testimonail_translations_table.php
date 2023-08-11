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
        Schema::create('testimonail_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('testimonail_id')->references('id')->on('testimonails');
            $table->foreignId('language_id')->references('id')->on('languages');
            $table->string('client_name');
            $table->longText('testimonail');
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
        Schema::dropIfExists('testimonail_translations');
    }
};
