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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->integer('number_of_days');
            $table->integer('number_of_meals');
            $table->integer('number_of_clients');
            $table->date('traveling_date');
            $table->date('return_date');
            $table->dateTime('meeting_time');
            $table->dateTime('departure_time');
            $table->string('price_includes');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries')->cascadeOnDelete();
            $table->enum('period', [
                '1-3 days',
                '3-5 days',
                '5-7 days',
                '7-10 days'
            ]);
            $table->double('price');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
};
