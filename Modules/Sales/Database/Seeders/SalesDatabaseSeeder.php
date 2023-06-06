<?php

namespace Modules\Sales\Database\Seeders;

use Illuminate\Database\Seeder;

class SalesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SalesPermissionsSeeder::class);
        $this->call(OrderStatusPermissionsSeeder::class);
        $this->call(OrderStatusDefinition::class);
    }
}
