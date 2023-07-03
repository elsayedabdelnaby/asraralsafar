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
        Schema::create('package_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->string('traveling_location');
            $table->string('type_of_rooms');
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('packages');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_translations');
    }
};
