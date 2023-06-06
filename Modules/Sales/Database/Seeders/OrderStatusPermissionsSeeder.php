<?php

namespace Modules\Sales\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Module;
use Modules\UsersManagement\Entities\Permission;
use Modules\UsersManagement\Services\ModelService;
use Modules\UsersManagement\Services\ProfileService;

class OrderStatusPermissionsSeeder extends Seeder
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
            ['name' => 'Order Status'],
            ['created_at' => now(), 'updated_at' => now()]
        );

        Permission::insert([
            ['name' => "access-order-status", 'module_id' => $module->id, 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
        ]);

        if ($module) {
            $model_service = new ModelService();
            // create the customer model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'OrderStatus',
                $module->id,
                [
                    'listing-orders-status',
                    'create-order-status',
                    'update-order-status',
                    'delete-order-status',
                    'view-order-status'
                ]
            );

            // assign all permissions to the administrator profile
            $profile_service = new ProfileService();
            $profile_service->assigndModulePermissionsToProfile(1, 'Order Status');
        }
    }
}
