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
        Schema::create('working_settings_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('working_setting_id')->references('id')->on('profiles');
            $table->foreignId('language_id')->references('id')->on('languages');
            $table->text('closing_reason')->nullable();
            $table->text('minimum_order_message')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('working_settings_translations');
    }
};
