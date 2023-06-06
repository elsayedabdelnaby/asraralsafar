<?php

namespace Modules\UsersManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Profile;
use Modules\UsersManagement\Entities\Permission;
use Modules\UsersManagement\Entities\ProfileTranslation;

class SuperAdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create the super admin profile
        $profile = Profile::create([
            'id' => 1,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ProfileTranslation::insert([
            [
                'profile_id' => $profile->id,
                'language_id' => 1,
                'name' => 'Super Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'profile_id' => $profile->id,
                'language_id' => 2,
                'name' => 'مدير النظام',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // add permissions to the super admin profile
        $profile->permissions()->sync(Permission::pluck('id')->toArray());
    }
}
