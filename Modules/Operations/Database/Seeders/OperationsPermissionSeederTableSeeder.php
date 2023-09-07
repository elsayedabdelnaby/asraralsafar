<?php

namespace Modules\Operations\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Module;
use Modules\UsersManagement\Entities\Permission;
use Modules\UsersManagement\Services\ModelService;
use Modules\UsersManagement\Services\ProfileService;

class OperationsPermissionSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create the Merchant module
        $module = Module::firstOrCreate([
            'name'       => 'Operations',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Permission::insert([
            'name'       => "access-operations",
            'module_id'  => $module->id,
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($module) {
            $modelService = new ModelService();

            //Create Operations  Delivery Guy
            $modelService->createModelAndAssignPermissions(
                'Activity Log',
                $module->id,
                [
                    'listing-activity-logs',
                ]
            );

            $modelService->createModelAndAssignPermissions(
                'Contact Us',
                $module->id,
                [
                    'listing-contact-us-messages',
                    'reply-on-contact-us-message',
                ]
            );

            $modelService->createModelAndAssignPermissions(
                'Booking Request',
                $module->id,
                [
                    'listing-booking-requests',
                    'edit-booking-request',
                ]
            );
        }

        // assign all permissions to the administrator profile
        $profile_service = new ProfileService();
        $profile_service->assigndModulePermissionsToProfile(1, 'Operations');
        $profile_service->clearUsersProfilePermissionsCache(1);
    }
}
