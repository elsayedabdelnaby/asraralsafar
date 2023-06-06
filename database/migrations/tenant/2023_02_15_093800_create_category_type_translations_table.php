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
        Schema::create('category_type_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_type_id')->references('id')->on('category_types');
            $table->foreignId('language_id')->references('id')->on('languages');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['category_type_id', 'language_id', 'deleted_at'], 'category_type_language_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_type_translations');
    }
};
