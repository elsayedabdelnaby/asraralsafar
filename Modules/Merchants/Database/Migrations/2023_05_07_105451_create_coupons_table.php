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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('merchant_id')->nullable()->references('id')->on('merchants');
            $table->enum('type', ['shipping', 'order'])->default('order');
            $table->enum('value_type', ['percentage', 'fixed'])->default('fixed');
            $table->double('value');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->tinyInteger('one_time')->default(0)->comment('1 => client can use the same coupon more than one time');
            $table->tinyInteger('first_order')->default(0)->comment('1 => coupon code applies only to the first order of the client');
            $table->integer('limited_usage')->nullable();
            $table->integer('user_max_usage')->nullable();
            $table->integer('min_order')->nullable();
            $table->integer('max_order')->nullable();
            $table->integer('min_shipping')->nullable();
            $table->integer('max_shipping')->nullable();
            $table->tinyInteger('apply_on_cash')->default(1);
            $table->tinyInteger('apply_on_card')->default(0);
            $table->enum('status', ['pending', 'available', 'expired'])->default('pending');
            $table->tinyInteger('is_active')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['code', 'deleted_at'], 'coupons_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
};
