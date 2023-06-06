<?php

namespace Modules\Merchants\Database\Seeders\Merchant;

use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Permission;
use Modules\UsersManagement\Entities\Profile;
use Modules\UsersManagement\Entities\ProfilePermission;

class MerchantManagerAssignPermission extends Seeder
{
    public function run()
    {
        //branches,hours,socials,fees,products,orders,Coupons...ets   ==> Reviews (When implement it add Permission Model Id)  And Access Merchants And Access Sales
        $profile = Profile::find(2);
        $profilePermissions = [];
        $allowedPermissions =     Permission::whereIn('model_id',[41,40,39,36,30,31,35,34,32,33,29,28,27])->pluck('id')->toArray();

        $allowedPermissions = array_merge($allowedPermissions,Permission::whereIn('name',['access-merchants','access-sales'])->pluck('id')->toArray());

        foreach ($allowedPermissions as $permission) {
            $profilePermissions[] = [
                'profile_id'    => $profile->id,
                'permission_id' => $permission
            ];
        }
        ProfilePermission::insert($profilePermissions);
    }
}
