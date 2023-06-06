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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_type_id')->nullable()->references('id')->on('category_types');
            $table->foreignId('parent_id')->nullable()->references('id')->on('categories');
            $table->string('image')->nullable();
            $table->boolean('is_active_in_mobile')->default(false);
            $table->integer('display_order_in_mobile')->default(0);
            $table->boolean('is_active_in_website')->default(false);
            $table->integer('display_order_in_website')->default(0);
            $table->boolean('is_display_home_page_of_mobile')->default(false);
            $table->integer('display_order_in_home_page_of_mobile')->default(0);
            $table->boolean('is_display_home_page_of_website')->default(false);
            $table->integer('display_order_in_home_page_of_website')->default(0);
            $table->boolean('is_display_in_fav_category_of_mobile')->default(false);
            $table->boolean('is_display_in_fav_category_of_webite')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
