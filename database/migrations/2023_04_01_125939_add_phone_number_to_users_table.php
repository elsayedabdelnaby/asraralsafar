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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number', 30)->nullable()->unique()->after('email');
            $table->string('otp', 6)->nullable()->after('phone_number');
            $table->timestamp('phone_verified_at')->after('email_verified_at')->nullable();
            $table->string('name')->nullable(true)->change();
            $table->string('email')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone_number');
            $table->dropColumn('otp');
            $table->dropColumn('phone_verified_at');
            $table->string('name')->change();
            $table->string('email')->change();
        });
    }
};
