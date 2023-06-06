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
        Schema::create('delivery_adjustment_applying', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_adjustment_id')->references('id')->on('delivery_adjustments');
            $table->foreignId('from_city_id')->nullable()->references('id')->on('cities');
            $table->foreignId('to_city_id')->nullable()->references('id')->on('cities');
            $table->foreignId('merchants_id')->nullable()->references('id')->on('merchants');
            $table->foreignId('product_id')->nullable()->references('id')->on('products');
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
        Schema::dropIfExists('delivery_adjustment_applying');
    }
};
