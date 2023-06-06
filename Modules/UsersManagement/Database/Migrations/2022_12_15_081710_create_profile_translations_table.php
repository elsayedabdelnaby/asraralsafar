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
        Schema::create('profile_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->references('id')->on('profiles');
            $table->foreignId('language_id')->references('id')->on('languages');
            $table->string('name', 100);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['profile_id', 'language_id', 'deleted_at'], 'profile_id_language_id_unique_app');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_translations');
    }
};
