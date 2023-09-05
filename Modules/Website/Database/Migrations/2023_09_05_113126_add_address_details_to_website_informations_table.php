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
        Schema::table('website_information_translations', function (Blueprint $table) {
            $table->text('address');
        });

        Schema::table('website_information', function (Blueprint $table) {
            $table->text('address_google_map_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('website_information_translations', function (Blueprint $table) {
            $table->dropColumn('address');
        });

        Schema::table('website_information', function (Blueprint $table) {
            $table->dropColumn('address_google_map_link');
        });
    }
};
