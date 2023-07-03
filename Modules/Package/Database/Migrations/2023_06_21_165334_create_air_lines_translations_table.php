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
        Schema::create('air_lines_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('air_lines_id');
            $table->foreign('air_lines_id')->references('id')->on('air_lines')->cascadeOnDelete();
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
        Schema::dropIfExists('air_lines_translations');
    }
};
