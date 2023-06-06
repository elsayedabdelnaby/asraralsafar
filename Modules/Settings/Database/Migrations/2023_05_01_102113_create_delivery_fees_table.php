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
        Schema::create('delivery_fees', function (Blueprint $table) {
            $table->id();
            $table->double('from');
            $table->double('to');
            $table->double('fees');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['from', 'to', 'deleted_at'], 'delivery_fees_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_fees');
    }
};
