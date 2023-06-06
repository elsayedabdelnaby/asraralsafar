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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_branch_id')->references('id')->on('merchant_branches');
            $table->foreignId('customer_id')->references('id')->on('users');
            $table->foreignId('address_id')->references('id')->on('customer_addresses');
            $table->foreignId('coupon_id')->nullable()->references('id')->on('coupons');
            $table->foreignId('delivery_id')->nullable()->references('id')->on('users');
            $table->unsignedDecimal('total');
            $table->enum('payment_method', ['cash_on_delivery', 'wallet'])->default('cash_on_delivery');
            $table->enum('status', ['requested', 'approved', 'processing', 'in_delivery', 'delivered'])->default('requested');
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
        Schema::dropIfExists('orders');
    }
};
