<?php

namespace Modules\Locations\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Module;
use Modules\UsersManagement\Entities\Permission;
use Modules\UsersManagement\Services\ModelService;
use Modules\UsersManagement\Services\ProfileService;

class LocationsPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create the Website module
        $module = Module::firstOrCreate(['name' => 'Locations', 'created_at' => now(), 'updated_at' => now()]);

        Permission::insert(['name' => "access-locations", 'module_id'  => $module->id, 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]);

        if ($module) {
            $model_service = new ModelService();
            // create the country model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Country',
                $module->id,
                [
                    'listing-countries',
                    'create-country',
                    'update-country',
                    'delete-country',
                    'view-country'
                ]
            );

            // create the state model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'State',
                $module->id,
                [
                    'listing-states',
                    'create-state',
                    'update-state',
                    'delete-state',
                    'view-state'
                ]
            );

            // create the city model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'City',
                $module->id,
                [
                    'listing-cities',
                    'create-city',
                    'update-city',
                    'delete-city',
                    'view-city'
                ]
            );
        }

        // assign all permissions to the administrator profile
        $profile_service = new ProfileService();
        $profile_service->assigndModulePermissionsToProfile(1, 'Locations');
        $profile_service->clearUsersProfilePermissionsCache(1);
    }
}
