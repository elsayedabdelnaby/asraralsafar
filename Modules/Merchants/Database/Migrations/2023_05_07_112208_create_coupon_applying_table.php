<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_applying', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coupon_id')->references('id')->on('coupons');
            $table->foreignId('city_id')->nullable()->references('id')->on('cities');
            $table->foreignId('branch_id')->nullable()->references('id')->on('merchant_branches');
            $table->foreignId('product_id')->nullable()->references('id')->on('merchant_branches');
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
        Schema::dropIfExists('coupon_applying');
    }
};
