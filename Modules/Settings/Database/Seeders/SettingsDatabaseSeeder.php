<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Settings\Database\Seeders\DefaultCategoryTypesTableSeeder;

class SettingsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingsPermissionsSeeder::class);
        $this->call(DefaultCategoryTypesTableSeeder::class);
        $this->call(DefaultCategoriesTableSeeder::class);
        $this->call(DefaultCurrenciesTableSeeder::class);
        $this->call(CuisinesCategoriesSeeder::class);
    }
}
