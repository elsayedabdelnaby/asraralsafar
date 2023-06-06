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
        Schema::create('profile_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->references('id')->on('profiles');
            $table->foreignId('permission_id')->references('id')->on('permissions');
            $table->unique(['profile_id', 'permission_id'], 'profile_id_permission_id_unique_app');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_permissions');
    }
};
