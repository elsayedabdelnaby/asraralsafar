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
        Schema::create('privacy_policy_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('privacy_policy_id')->references('id')->on('privacy_policies');
            $table->foreignId('language_id')->references('id')->on('languages');
            $table->string('title');
            $table->longText('description');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['privacy_policy_id', 'language_id', 'deleted_at'], 'policy_id_language_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privacy_policy_translations');
    }
};
