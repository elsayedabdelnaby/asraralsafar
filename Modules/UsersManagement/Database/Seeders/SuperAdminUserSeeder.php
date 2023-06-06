<?php

namespace Modules\UsersManagement\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // creat the super admin user
        $user = User::updateOrCreate([
            'id' => 1,
            'name' => 'Super Admin',
            'email' => 'super-admin@admin.com',
            'type' => 'admin',
            'password' => Hash::make('admin'),
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
