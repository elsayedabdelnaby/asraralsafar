<?php

namespace Modules\Merchants\Database\Seeders\BranchManger;

use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Permission;
use Modules\UsersManagement\Entities\Profile;
use Modules\UsersManagement\Entities\Role;
use Modules\UsersManagement\Entities\RoleTranslation;

class   BranchManagerRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Get Branch Manager Profile
        $profile = Profile::find(3);

        // create the Merchant Manager role
        $role = Role::create([
            'id'         => 3,
            'is_active'  => true,
            'report_to'  => null,
            'root_path'  => 'H1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $role->profiles()->sync($profile->id);

        RoleTranslation::insert([
            [
                'role_id'     => $role->id,
                'language_id' => 1,
                'name'        => 'Branch Manager',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'role_id'     => $role->id,
                'language_id' => 2,
                'name'        => 'المدير الفرع',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        ]);
    }
}
