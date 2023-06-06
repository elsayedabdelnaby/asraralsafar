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
        Schema::create('website_information', function (Blueprint $table) {
            $table->id();
            $table->string('main_logo')->nullable();
            $table->string('footer_logo')->nullable();
            $table->longText('facebook_pixel_code')->nullable();
            $table->longText('google_analytics_code')->nullable();
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
        Schema::dropIfExists('website_information');
    }
};
