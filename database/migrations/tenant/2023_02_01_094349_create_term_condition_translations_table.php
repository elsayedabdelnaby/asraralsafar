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
        Schema::create('term_condition_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('term_condition_id')->references('id')->on('terms_conditions');
            $table->foreignId('language_id')->references('id')->on('languages');
            $table->string('title');
            $table->longText('description');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['term_condition_id', 'language_id', 'deleted_at'], 'term_condition_id_language_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('term_condition_translations');
    }
};
