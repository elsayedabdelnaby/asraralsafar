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
        Schema::create('role_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->references('id')->on('profiles');
            $table->foreignId('role_id')->references('id')->on('roles');
            $table->unique(['profile_id', 'role_id'], 'profile_id_role_id_unique_app');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_profiles');
    }
};
