<?php

namespace Modules\Website\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Website\Entities\ContactInformation;

class ContactInformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactInformation::insert([
            [
                'id' => 1,
                'is_active' => true,
                'value' => "00966509433555",
                'type' => "phone",
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => 2,
                'is_active' => true,
                'value' => "00966509433555",
                'type' => "email",
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => 3,
                'is_active' => true,
                'value' => "00966509433555",
                'type' => "whatsapp",
                'created_by' => 1,
                'updated_by' => 1,
            ]
        ]);
    }
}
