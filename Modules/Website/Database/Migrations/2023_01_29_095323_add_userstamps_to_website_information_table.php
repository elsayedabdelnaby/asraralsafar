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
        Schema::table('website_information', function (Blueprint $table) {
            $table->foreignId('created_by')->references('id')->on('users')->after('created_at');
            $table->foreignId('updated_by')->references('id')->on('users')->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('website_information', function (Blueprint $table) {
            $table->dropForeign('website_information_created_by_foreign');
            $table->dropForeign('website_information_updated_by_foreign');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
};
