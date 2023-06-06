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
        Schema::create('coupon_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('coupon_id')->references('id')->on('coupons');
            $table->foreignId('language_id')->references('id')->on('languages');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['coupon_id', 'language_id', 'deleted_at'], 'coupon_language_unique');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_translations');
    }
};
