<?php

namespace Modules\Locations\Database\Seeders;

use Illuminate\Database\Seeder;

class LocationsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LocationsPermissionsSeeder::class);
        $this->call(DefaultLocationsSeeder::class);
    }
}
