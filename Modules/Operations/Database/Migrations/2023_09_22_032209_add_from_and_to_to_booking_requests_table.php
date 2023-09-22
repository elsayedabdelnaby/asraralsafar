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
        Schema::table('booking_requests', function (Blueprint $table) {
            $table->foreignId('from_country_id')->nullable()->references('id')->on('countries');
            $table->foreignId('from_state_id')->nullable()->references('id')->on('states');
            $table->foreignId('from_city_id')->nullable()->references('id')->on('cities');
            $table->foreignId('to_country_id')->nullable()->references('id')->on('countries');
            $table->foreignId('to_state_id')->nullable()->references('id')->on('states');
            $table->foreignId('to_city_id')->nullable()->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_requests', function (Blueprint $table) {
            $table->dropColumn('from_country_id');
            $table->dropColumn('from_state_id');
            $table->dropColumn('from_city_id');
            $table->dropColumn('to_country_id');
            $table->dropColumn('to_state_id');
            $table->dropColumn('to_city_id');
        });
    }
};
