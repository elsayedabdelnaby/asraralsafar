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
        Schema::create('product_attribute_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_attribute_id')->references('id')->on('product_attributes');
            $table->foreignId('language_id')->references('id')->on('languages');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['product_attribute_id', 'language_id', 'deleted_at'], 'product_attribute_language_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attribute_translations');
    }
};
