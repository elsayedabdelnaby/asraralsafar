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
        Schema::create('meta_pages', function (Blueprint $table) {
            $table->id();
            $table->enum('page', [
                'home', 'login', 'privacy_policy', 'contact_us', 'careers', 'about', 'terms_conditions',
                'checkout', 'thanks_page', 'tracking_order', 'blogs', 'products', 'restaurants', 'grocery', 'categories', 'offers'
            ]);
            $table->string('image');
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
        Schema::dropIfExists('meta_pages');
    }
};
