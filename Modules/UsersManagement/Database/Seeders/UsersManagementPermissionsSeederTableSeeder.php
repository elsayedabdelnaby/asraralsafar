<?php

namespace Modules\UsersManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Model;
use Modules\UsersManagement\Entities\Module;
use Modules\UsersManagement\Entities\Permission;
use Modules\UsersManagement\Services\ModelService;

class UsersManagementPermissionsSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create the Users Management module
        $module = Module::firstOrCreate(
            ['name' => 'Users Management'],
            ['created_at' => now(), 'updated_at' => now()]
        );

        Permission::insert([
            ['name' => "access-users-management", 'module_id' => $module->id, 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
        ]);

        if ($module) {
            $model_service = new ModelService();
            // create the profile model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Profile',
                $module->id,
                [
                    'listing-profiles',
                    'create-profile',
                    'update-profile',
                    'delete-profile',
                    'view-profile'
                ]
            );

            // create the role model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Role',
                $module->id,
                [
                    'listing-roles',
                    'create-role',
                    'update-role',
                    'delete-role',
                    'view-role'
                ]
            );

            // create the User model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'User',
                $module->id,
                [
                    'listing-users',
                    'create-user',
                    'update-user',
                    'delete-user',
                    'view-user'
                ]
            );

            // create the Avatar model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Avatar',
                $module->id,
                [
                    'listing-avatars',
                    'create-avatar',
                    'update-avatar',
                    'delete-avatar',
                    'view-avatar'
                ]
            );
        }
    }
}
