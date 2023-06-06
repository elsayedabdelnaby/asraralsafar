<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_guys', function (Blueprint $table) {
            $table->foreignId('created_by')->references('id')->on('users')->after('created_at');
            $table->foreignId('updated_by')->references('id')->on('users')->after('updated_at');
            $table->foreignId('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_guys', function (Blueprint $table) {
            $table->dropForeign('delivery_guys_user_id_foreign');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('deleted_by');
        });
    }
};
