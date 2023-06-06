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
        Schema::create('meta_page_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meta_page_id')->references('id')->on('meta_pages');
            $table->foreignId('language_id')->references('id')->on('languages');
            $table->string('title', 65);
            $table->string('description', 320);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['meta_page_id', 'language_id', 'deleted_at'], 'meta_page_id_language_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta_page_translations');
    }
};
