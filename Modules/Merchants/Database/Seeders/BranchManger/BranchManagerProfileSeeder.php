<?php

namespace Modules\Merchants\Database\Seeders\BranchManger;

use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Permission;
use Modules\UsersManagement\Entities\Profile;
use Modules\UsersManagement\Entities\ProfilePermission;
use Modules\UsersManagement\Entities\ProfileTranslation;

class BranchManagerProfileSeeder extends Seeder
{
    public function run()
    {
        // Create the Branch Manager profile
        $profile = Profile::create([
            'id' => 3,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ProfileTranslation::insert([
            [
                'profile_id' => $profile->id,
                'language_id' => 1,
                'name' => 'Branch Manager',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'profile_id' => $profile->id,
                'language_id' => 2,
                'name' => 'مدير الفرع',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
