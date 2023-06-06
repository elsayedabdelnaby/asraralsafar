<?php

namespace Modules\Sales\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Module;
use Modules\UsersManagement\Entities\Permission;
use Modules\UsersManagement\Services\ModelService;
use Modules\UsersManagement\Services\ProfileService;

class SalesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create the Sales module
        $module = Module::firstOrCreate(
            ['name' => 'Sales'],
            ['created_at' => now(), 'updated_at' => now()]
        );

        Permission::insert([
            ['name' => "access-sales", 'module_id' => $module->id, 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
        ]);

        if ($module) {
            $model_service = new ModelService();
            // create the customer model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Customer',
                $module->id,
                [
                    'listing-customers',
                    'create-customer',
                    'update-customer',
                    'delete-customer',
                    'view-customer'
                ]
            );

            // create the addresses model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Customer Address',
                $module->id,
                [
                    'listing-customer-addresses',
                    'create-customer-address',
                    'update-customer-address',
                    'delete-customer-address',
                    'view-customer-address'
                ]
            );


            // create the order model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Order',
                $module->id,
                [
                    'listing-orders',
                    'create-order',
                    'update-order',
                    'delete-order',
                    'view-order'
                ]
            );

            // assign all permissions to the administrator profile
            $profile_service = new ProfileService();
            $profile_service->assigndModulePermissionsToProfile(1, 'Sales');
        }
    }
}
