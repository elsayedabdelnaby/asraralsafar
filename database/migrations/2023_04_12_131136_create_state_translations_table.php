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
        Schema::create('state_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->foreignId('state_id')->references('id')->on('states');
            $table->foreignId('language_id')->references('id')->on('languages');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['state_id', 'language_id', 'deleted_at'], 'state_language_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('state_translations');
    }
};
