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
        Schema::create('tag_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->references('id')->on('tags');
            $table->foreignId('language_id')->references('id')->on('languages');
            $table->string('name', 50);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['tag_id', 'language_id', 'deleted_at'], 'tag_language_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_translations');
    }
};
