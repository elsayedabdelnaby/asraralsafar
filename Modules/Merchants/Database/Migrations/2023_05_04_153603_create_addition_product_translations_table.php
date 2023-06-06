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
        Schema::create('addition_product_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('addition_product_id')->references('id')->on('additions_products');
            $table->foreignId('language_id')->references('id')->on('languages');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['addition_product_id', 'language_id', 'deleted_at'], 'product_language_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addition_product_translations');
    }
};
