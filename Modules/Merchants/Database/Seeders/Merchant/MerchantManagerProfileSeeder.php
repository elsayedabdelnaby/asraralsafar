<?php

namespace Modules\Merchants\Database\Seeders\Merchant;

use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Permission;
use Modules\UsersManagement\Entities\Profile;
use Modules\UsersManagement\Entities\ProfileTranslation;

class MerchantManagerProfileSeeder extends Seeder
{
    public function run()
    {
        // create the super admin profile
        $profile = Profile::create([
            'id' => 2,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ProfileTranslation::insert([
            [
                'profile_id' => $profile->id,
                'language_id' => 1,
                'name' => 'Merchant Manager',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'profile_id' => $profile->id,
                'language_id' => 2,
                'name' => 'مدير التاجر',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
