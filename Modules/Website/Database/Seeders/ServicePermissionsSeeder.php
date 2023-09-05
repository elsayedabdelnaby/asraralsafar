<?php

namespace Modules\Website\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Module;
use Modules\UsersManagement\Services\ModelService;
use Modules\UsersManagement\Services\ProfileService;

class ServicePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $module = Module::where('name', 'Website')->first();

        $model_service = new ModelService();

        // create the Service type model and insert basics permissions of it
        $model_service->createModelAndAssignPermissions(
            'Service',
            $module->id,
            [
                'listing-services',
                'create-service',
                'update-service',
                'delete-service',
                'view-service'
            ]
        );

        // assign all permissions to the administrator profile
        $profile_service = new ProfileService();
        $profile_service->assignModelsPermissionsToProfile(1, ['Service']);
    }
}
