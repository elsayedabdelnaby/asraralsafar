<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Package\Database\Seeders\PackageTableSeeder;
use Modules\Website\Database\Seeders\AboutUsTableSeeder;
use Modules\Website\Database\Seeders\WebsiteDatabaseSeeder;
use Modules\Settings\Database\Seeders\SettingsDatabaseSeeder;
use Modules\Locations\Database\Seeders\LocationsDatabaseSeeder;
use Modules\Operations\Database\Seeders\OperationsDatabaseSeeder;
use Modules\Package\Database\Seeders\CruiseTableSeeder;
use Modules\Package\Database\Seeders\FlightTableSeeder;
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
            OperationsDatabaseSeeder::class,
            AboutUsTableSeeder::class,
            PackageTableSeeder::class,
            FlightTableSeeder::class,
            CruiseTableSeeder::class
        ]);
    }
}
