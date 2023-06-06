<?php

namespace Modules\Merchants\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Module;
use Modules\UsersManagement\Services\ModelService;
use Modules\UsersManagement\Services\ProfileService;

class DeliveryAdjustmentsPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get the Merchant module
        $module = Module::where('name', 'Merchants')->first();

        if ($module) {
            $modelService = new ModelService();

            // permissions of the Delivery Adjustments
            $modelService->createModelAndAssignPermissions(
                'Delivery Adjustments',
                $module->id,
                [
                    'listing-merchant-delivery-adjustments',
                    'create-merchant-delivery-adjustment',
                    'update-merchant-delivery-adjustment',
                    'delete-merchant-delivery-adjustment',
                    'view-merchant-delivery-adjustment'
                ]
            );
        }

        // assign all permissions to the administrator profile
        $profile_service = new ProfileService();
        $profile_service->assignModelsPermissionsToProfile(1, ['Delivery Adjustments']);
        $profile_service->clearUsersProfilePermissionsCache(1);
    }
}
