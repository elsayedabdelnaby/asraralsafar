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
        Schema::create('delivery_adjustment_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_adjustment_id')->references('id')->on('delivery_adjustments');
            $table->foreignId('language_id')->references('id')->on('languages');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_adjustment_translations');
    }
};
