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
        Schema::table('merchants', function (Blueprint $table) {
            $table->string('hot_line')->after('request_status');
            $table->double('minimum_delivery_charges')->after('order_minimum_amount')->default(0);
            $table->boolean('has_branches')->after('hot_line');
            $table->boolean('working_status')->after('has_branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
