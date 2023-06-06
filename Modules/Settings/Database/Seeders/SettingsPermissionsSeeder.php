<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Model;
use Modules\UsersManagement\Entities\Module;
use Modules\UsersManagement\Entities\Permission;
use Modules\UsersManagement\Services\ModelService;
use Modules\UsersManagement\Services\ProfileService;

class SettingsPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create the Settings module
        $module = Module::firstOrCreate(
            ['name' => 'Settings'],
            ['created_at' => now(), 'updated_at' => now()]
        );

        Permission::insert([
            ['name' => "access-settings", 'module_id' => $module->id, 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
        ]);

        if ($module) {
            // create the operation settings model
            $model = Model::create(['name' => 'Operation Settings', 'module_id' => $module->id, 'created_at' => now(), 'updated_at' => now()]);
            // insert the update operation settings
            Permission::insert([
                ['name' => 'update-' . Str::slug($model->name), 'module_id' => $module->id, 'model_id' => $model->id, 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]
            ]);

            $model_service = new ModelService();
            // create the category type model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Category Type',
                $module->id,
                [
                    'listing-category-types',
                    'create-category-type',
                    'update-category-type',
                    'delete-category-type',
                    'view-category-type'
                ]
            );

            // create the category model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Category',
                $module->id,
                [
                    'listing-categories',
                    'create-category',
                    'update-category',
                    'delete-category',
                    'view-category',
                    'exporting-merchant-categories',
                ]
            );


            // create the tag model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Tag',
                $module->id,
                [
                    'listing-tags',
                    'create-tag',
                    'update-tag',
                    'delete-tag',
                    'view-tag'
                ]
            );


            // create the language model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Language',
                $module->id,
                [
                    'listing-languages',
                    'create-language',
                    'update-language',
                    'delete-language',
                    'view-language'
                ]
            );


            // create the currency model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Currency',
                $module->id,
                [
                    'listing-currencies',
                    'create-currency',
                    'update-currency',
                    'delete-currency',
                    'view-currency'
                ]
            );

            // create the delivery model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Delivery',
                $module->id,
                [
                    'listing-delivery_fees',
                    'create-delivery_fee',
                    'update-delivery_fee',
                    'delete-delivery_fee',
                    'view-delivery_fee'
                ]
            );

            // assign all permissions to the administrator profile
            $profile_service = new ProfileService();
            $profile_service->assigndModulePermissionsToProfile(1, 'Settings');
        }
    }
}
