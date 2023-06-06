<?php

namespace Modules\Operations\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Module;
use Modules\Operations\Entities\WorkingSetting;
use Modules\UsersManagement\Services\ModelService;
use Modules\UsersManagement\Services\ProfileService;
use Modules\Operations\Entities\WorkingSettingTranslation;

class WorkingSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create permissions
        $module = Module::where('name', 'Operations')->first();
        if ($module) {
            $modelService = new ModelService();
            $modelService->createModelAndAssignPermissions(
                'Working Settings',
                $module->id,
                [
                    'edit-working-settings',
                ]
            );
        }

        // assign all permissions to the administrator profile
        $profile_service = new ProfileService();
        $profile_service->assigndModulePermissionsToProfile(1, 'Operations');
        $profile_service->clearUsersProfilePermissionsCache(1);

        // seeds the default value
        $working_settings = WorkingSetting::create([
            'is_working' => true,
            'low_demand_active' => false,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        WorkingSettingTranslation::insert([
            ['working_setting_id' => $working_settings->id, 'language_id' => 1, 'closing_reason' => '', 'minimum_order_message' => ''],
            ['working_setting_id' => $working_settings->id, 'language_id' => 2, 'closing_reason' => '', 'minimum_order_message' => '']
        ]);
    }
}
