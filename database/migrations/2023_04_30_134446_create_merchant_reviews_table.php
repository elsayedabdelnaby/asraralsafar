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
        Schema::create('merchant_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->references('id')->on('merchants');
            $table->date('date');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->double('speed_rate')->default(0);
            $table->double('service_rate')->default(0);
            $table->double('tasty_rate')->default(0);
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('merchant_reviews');
    }
};
