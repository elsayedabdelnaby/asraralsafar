<?php

namespace Modules\Merchants\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Module;
use Modules\UsersManagement\Services\ModelService;
use Modules\UsersManagement\Services\ProfileService;

class ProductsPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create the Merchant module
        $module = Module::where('name', 'Merchants')->first();

        if ($module) {
            $modelService = new ModelService();

            // permissions of the products
            $modelService->createModelAndAssignPermissions(
                'Products',
                $module->id,
                [
                    'listing-products',
                    'create-product',
                    'update-product',
                    'delete-product',
                    'view-product',
                    'export-products',
                    'import-price',
                    'import-product',
                ]
            );

            // permissions of the product variants
            $modelService->createModelAndAssignPermissions(
                'Product Variants',
                $module->id,
                [
                    'listing-product-variants',
                    'create-product-variant',
                    'update-product-variant',
                    'delete-product-variant',
                    'view-product-variant'
                ]
            );

            // permissions of the addition products
            $modelService->createModelAndAssignPermissions(
                'Addition Products',
                $module->id,
                [
                    'listing-addition-products',
                    'create-addition-product',
                    'update-addition-product',
                    'delete-addition-product',
                    'view-addition-product'
                ]
            );

            // permissions of the product attributes
            $modelService->createModelAndAssignPermissions(
                'Product Attributes',
                $module->id,
                [
                    'listing-product-attributes',
                    'create-product-attribute',
                    'update-product-attribute',
                    'delete-product-attribute',
                    'view-product-attribute'
                ]
            );
        }

        // assign all permissions to the administrator profile
        $profile_service = new ProfileService();
        $profile_service->assignModelsPermissionsToProfile(1, ['Products', 'Product Variants', 'Addition Products', 'Product Attributes']);
        $profile_service->clearUsersProfilePermissionsCache(1);
    }
}
