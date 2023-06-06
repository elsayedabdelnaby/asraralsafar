<?php

namespace Modules\Merchants\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Merchants\Database\Seeders\BranchManger\BranchManagerAssignPermission;
use Modules\Merchants\Database\Seeders\BranchManger\BranchManagerProfileSeeder;
use Modules\Merchants\Database\Seeders\BranchManger\BranchManagerRoleSeeder;
use Modules\Merchants\Database\Seeders\Merchant\MerchantManagerAssignPermission;
use Modules\Merchants\Database\Seeders\Merchant\MerchantManagerProfileSeeder;
use Modules\Merchants\Database\Seeders\Merchant\MerchantManagerRoleSeeder;
use Modules\Merchants\Database\Seeders\Merchant\MerchantsPermissionSeederTableSeeder;

class MerchantsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MerchantsPermissionSeederTableSeeder::class);
        $this->call(ProductsPermissionSeeder::class);
        $this->call(DeliveryAdjustmentsPermissionSeeder::class);

        //Create Merchant Branch Manager Profile&Role And Assign Merchant Permission To Him
        $this->call(BranchManagerProfileSeeder::class);
        $this->call(BranchManagerRoleSeeder::class);
        $this->call(BranchManagerAssignPermission::class);


        //Create  Merchant Manger Profile&Role And Assign Merchant Permission To Him
        $this->call(MerchantManagerProfileSeeder::class);
        $this->call(MerchantManagerRoleSeeder::class);
        $this->call(MerchantManagerAssignPermission::class);

    }
}
