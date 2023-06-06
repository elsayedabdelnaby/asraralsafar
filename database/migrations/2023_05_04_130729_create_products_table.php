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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['simple', 'variant']);
            $table->string('image');
            $table->foreignId('merchant_id')->references('id')->on('merchants');
            $table->foreignId('category_type_id')->references('id')->on('categories'); // category type of the product (restaurant, bakery, supermarket)
            $table->foreignId('category_id')->references('id')->on('categories'); // product category
            $table->boolean('accept_additions')->default(false);
            $table->unsignedDecimal('price')->nullable(); //required in case of simple product and null in variant case
            $table->unsignedDecimal('discount_price')->nullable();
            $table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('products');
    }
};
