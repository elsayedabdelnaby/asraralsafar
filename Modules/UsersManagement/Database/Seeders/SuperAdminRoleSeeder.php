<?php

namespace Modules\UsersManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Role;
use Modules\UsersManagement\Entities\Profile;
use Modules\UsersManagement\Entities\Permission;
use Modules\UsersManagement\Entities\RoleTranslation;

class SuperAdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create the super admin profile
        $profile = Profile::find(1);

        // add permissions to the super admin profile
        $profile->permissions()->sync(Permission::pluck('id')->toArray());

        // create the super admin role
        $role = Role::create([
            'id' => 1,
            'is_active' => true,
            'report_to' => null,
            'root_path' => 'H1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $role->profiles()->sync($profile->id);

        RoleTranslation::insert([
            [
                'role_id' => $role->id,
                'language_id' => 1,
                'name' => 'CEO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => $role->id,
                'language_id' => 2,
                'name' => 'المدير التنفيذي',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
