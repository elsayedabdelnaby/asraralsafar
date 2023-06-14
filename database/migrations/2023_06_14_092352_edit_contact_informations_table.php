<?php

use Illuminate\Support\Facades\DB;
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
        DB::statement("ALTER TABLE contact_informations MODIFY type ENUM('phone', 'email', 'contactus', 'careers', 'whatsapp', 'location')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE contact_informations MODIFY type ENUM('phone', 'email', 'contactus', 'careers', 'whatsapp')");
    }
};
