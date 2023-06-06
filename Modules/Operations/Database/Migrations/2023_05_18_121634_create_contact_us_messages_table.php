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
        Schema::create('contact_us_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('title');
            $table->text('message');
            $table->text('answer')->nullable();
            $table->foreignId('who_reply_id')->nullable()->references('id')->on('users')->comment('the email of the user which reply on this message');
            $table->enum('status', ['new', 'processing', 'done'])->default('new');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->after('created_at');
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->after('updated_at');
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
        Schema::dropIfExists('contact_us_messages');
    }
};
