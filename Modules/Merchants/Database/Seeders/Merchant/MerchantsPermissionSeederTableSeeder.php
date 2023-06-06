<?php

namespace Modules\Merchants\Database\Seeders\Merchant;

use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Module;
use Modules\UsersManagement\Entities\Permission;
use Modules\UsersManagement\Services\ModelService;
use Modules\UsersManagement\Services\ProfileService;

class MerchantsPermissionSeederTableSeeder extends Seeder
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
            'name'       => 'Merchants',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Permission::insert([
            'name'       => "access-merchants",
            'module_id'  => $module->id,
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($module) {
            $modelService = new ModelService();

            //Create Merchant Permissions
            $this->createMerchantsPermissions($module->id, $modelService);

            //Create Branches Permission
            $this->createMerchantsBranchesPermissions($module->id, $modelService);

            //Create Working Hours Permission
            $this->createMerchantsWorkingHoursPermission($module->id, $modelService);

            //Create Social Permission
            $this->createMerchantsSocialPermission($module->id, $modelService);

            //Create Working Hours Permission
            $this->createMerchantsDeliveryFeesPermission($module->id, $modelService);

            //Create Additions Products Additions  Permission
            $this->createMerchantsAdditionsProducts($module->id, $modelService);

            //Create Additions Product Variant  Permission
            $this->createMerchantsProductVariant($module->id, $modelService);
            //Create Coupons Permission
            $this->createMerchantCouponsPermission($module->id, $modelService);
        }

        // assign all permissions to the administrator profile
        $profile_service = new ProfileService();
        $profile_service->assigndModulePermissionsToProfile(1, 'Merchants');
        $profile_service->clearUsersProfilePermissionsCache(1);
    }


    private function createMerchantsPermissions($module_id, ModelService $modelService)
    {
        $modelService->createModelAndAssignPermissions(
            'Merchants',
            $module_id,
            [
                'listing-merchants',
                'create-merchant',
                'update-merchant',
                'delete-merchant',
                'view-merchant'
            ]
        );
    }

    private function createMerchantsBranchesPermissions($module_id, ModelService $modelService)
    {
        $modelService->createModelAndAssignPermissions(
            'Merchant Branches',
            $module_id,
            [
                'listing-merchant-branches',
                'create-merchant-branches',
                'update-merchant-branches',
                'delete-merchant-branches',
                'view-merchant-branches'
            ]
        );
    }

    private function createMerchantsWorkingHoursPermission($module_id, ModelService $modelService)
    {
        $modelService->createModelAndAssignPermissions(
            'Merchant Working Hours',
            $module_id,
            [
                'listing-merchant-working-hours',
                'create-merchant-working-hours',
                'update-merchant-working-hours',
                'delete-merchant-working-hours',
                'view-merchant-working-hours'
            ]
        );
    }

    private function createMerchantsSocialPermission($module_id, ModelService $modelService)
    {
        $modelService->createModelAndAssignPermissions(
            'Merchant Social',
            $module_id,
            [
                'listing-merchant-socials',
                'create-merchant-social',
                'update-merchant-social',
                'delete-merchant-social',
                'view-merchant-social'
            ]
        );
    }

    private function createMerchantsDeliveryFeesPermission($module_id, ModelService $modelService)
    {
        $modelService->createModelAndAssignPermissions(
            'Merchant Delivery Fees',
            $module_id,
            [
                'listing-merchant-delivery-fees',
                'create-merchant-delivery-fees',
                'update-merchant-delivery-fees',
                'delete-merchant-delivery-fees',
                'view-merchant-delivery-fees'
            ]
        );
    }

    private function createMerchantsAdditionsProducts($module_id, ModelService $modelService)
    {
        $modelService->createModelAndAssignPermissions(
            'Merchant Additions Products',
            $module_id,
            [
                'listing-merchant-additions-products',
                'create-merchant-additions-product',
                'update-merchant-additions-product',
                'delete-merchant-additions-product',
                'view-merchant-additions-product'
            ]
        );
    }

    private function createMerchantsProductVariant($module_id, ModelService $modelService)
    {
        $modelService->createModelAndAssignPermissions(
            'Merchant Product Variants',
            $module_id,
            [
                'listing-merchant-product-variants',
                'create-merchant-product-variant',
                'update-merchant-product-variant',
                'delete-merchant-product-variant',
                'view-merchant-product-variant'
            ]
        );
    }
    private function createMerchantCouponsPermission($module_id, ModelService $modelService): void
    {
        $modelService->createModelAndAssignPermissions(
            'Merchant Coupons',
            $module_id,
            [
                'listing-merchant-coupons',
                'create-merchant-coupon',
                'update-merchant-coupon',
                'delete-merchant-coupon',
                'view-merchant-coupon'
            ]
        );
    }
}
