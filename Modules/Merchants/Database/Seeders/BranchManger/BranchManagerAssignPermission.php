<?php

namespace Modules\Merchants\Database\Seeders\BranchManger;

use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Permission;
use Modules\UsersManagement\Entities\Profile;
use Modules\UsersManagement\Entities\ProfilePermission;
use Modules\UsersManagement\Entities\ProfileTranslation;

class BranchManagerAssignPermission extends Seeder
{
    public function run()
    {
        $profile = Profile::find(3);
        $profilePermissions = [];
        $allowedPermissions =     Permission::whereIn('model_id',[41,40,39])->pluck('id')->toArray();

        $allowedPermissions = array_merge($allowedPermissions,Permission::whereIn('name',['access-sales'])->pluck('id')->toArray());

        foreach ($allowedPermissions as $permission) {
            $profilePermissions[] = [
                'profile_id'    => $profile->id,
                'permission_id' => $permission
            ];
        }
        ProfilePermission::insert($profilePermissions);
    }
}
