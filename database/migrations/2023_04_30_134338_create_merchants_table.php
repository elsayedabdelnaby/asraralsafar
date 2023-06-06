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
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->boolean('is_active')->default(false);
            $table->double('order_minimum_amount')->default(0);
            $table->integer('reviews_count')->default(0);
            $table->integer('average_delivery_time')->nullable();
            $table->double('maximum_distance');
            $table->enum('request_status',['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('owner_id')->references('id')->on('users');
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
        Schema::dropIfExists('merchants');
    }
};
