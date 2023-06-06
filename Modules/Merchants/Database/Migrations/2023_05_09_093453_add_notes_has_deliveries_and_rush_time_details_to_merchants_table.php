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
        Schema::table('merchants', function (Blueprint $table) {
            $table->boolean('has_deliveries')->default(false)->after('has_branches');
            $table->text('notes')->nullable()->after('owner_id');
            $table->boolean('rush_time_status')->default(false)->after('request_status');
            $table->unsignedDecimal('rush_time_additional_fees')->nullable()->after('rush_time_status');
        });

        Schema::table('merchant_translations', function (Blueprint $table) {
            $table->string("rush_time_message")->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->dropColumn('has_deliveries');
            $table->dropColumn('notes');
            $table->dropColumn('rush_time_status');
            $table->dropColumn('rush_time_additional_fees');
        });

        Schema::table('merchant_translations', function (Blueprint $table) {
            $table->dropColumn("rush_time_message");
        });
    }
};
