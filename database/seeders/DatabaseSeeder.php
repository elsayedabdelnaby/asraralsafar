<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Website\Database\Seeders\WebsiteDatabaseSeeder;
use Modules\Settings\Database\Seeders\SettingsDatabaseSeeder;
use Modules\Locations\Database\Seeders\LocationsDatabaseSeeder;
use Modules\Operations\Database\Seeders\OperationsDatabaseSeeder;
use Modules\UsersManagement\Database\Seeders\UsersManagementDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LanguagesSeeder::class,
            UsersManagementDatabaseSeeder::class,
            WebsiteDatabaseSeeder::class,
            SettingsDatabaseSeeder::class,
            LocationsDatabaseSeeder::class,
            OperationsDatabaseSeeder::class
        ]);
    }
}
