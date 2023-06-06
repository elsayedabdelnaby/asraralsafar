<?php

namespace Modules\UsersManagement\Database\Seeders;

use Illuminate\Database\Seeder;

class UsersManagementDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersManagementPermissionsSeederTableSeeder::class);
        $this->call(SuperAdminProfileSeeder::class);
        $this->call(SuperAdminRoleSeeder::class);
        $this->call(SuperAdminUserSeeder::class);
    }
}
