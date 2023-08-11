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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->smallInteger('display_order');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->softDeletes();
            // userstamps
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
        Schema::dropIfExists('partners');
    }
};
