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
        Schema::create('merchant_social', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->references('id')->on('merchants');
            $table->string('display');
            $table->string('icon');
            $table->string('url');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['url', 'deleted_at'], 'unique_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_social');
    }
};
