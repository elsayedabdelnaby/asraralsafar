<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::insert([
            ['id' => 1, 'name' => 'English', 'code' => 'en', 'icon' => '<i class="flag-icon flag-icon-us"></i>', 'direction' => 'ltr', 'created_at' => now(), 'updated_at' => now(),],
            ['id' => 2, 'name' => 'Arabic',  'code' => 'ar', 'icon' => '<i class="flag-icon flag-icon-eg"></i>', 'direction' => 'rtl', 'created_at' => now(), 'updated_at' => now(),]
        ]);
    }
}
