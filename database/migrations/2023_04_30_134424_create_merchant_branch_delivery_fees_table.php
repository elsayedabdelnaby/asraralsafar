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
        Schema::create('merchant_branch_delivery_fees', function (Blueprint $table) {
            $table->id();
            $table->double('from');
            $table->double('to');
            $table->double('fees');
            $table->foreignId('merchant_branch_id')->references('id')->on('merchant_branches');
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
        Schema::dropIfExists('merchant_branch_delivery_fees');
    }
};
