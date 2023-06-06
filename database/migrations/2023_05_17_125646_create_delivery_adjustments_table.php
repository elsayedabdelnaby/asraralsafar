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
        Schema::create('delivery_adjustments', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->time('start_time');
            $table->date('end_date');
            $table->time('end_time');
            $table->double('minimum_order_value');
            $table->double('maximum_order_value');
            $table->double('minimum_shipping_cost_value');
            $table->double('maximum_shipping_cost_value');
            $table->enum('type',['cities','merchants','products']);
            $table->enum('value_type',['percentage','amount']);
            $table->double('value');
            $table->boolean('apply_on_cash_on_delivery');
            $table->boolean('apply_on_pay_from_wallet');
            $table->boolean('is_active');
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
        Schema::dropIfExists('delivery_adjustments');
    }
};
