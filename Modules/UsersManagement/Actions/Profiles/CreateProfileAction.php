<?php

namespace Modules\UsersManagement\Actions\Profiles;

use Modules\UsersManagement\Entities\Profile;
use Modules\UsersManagement\Entities\ProfileTranslation;
use Modules\UsersManagement\Http\Requests\Profiles\CreateProfileRequest;

/**
 * @purpose create a new profile
 */
class CreateProfileAction
{
    public function handle(CreateProfileRequest $request): Profile
    {
        //prepare the permissions
        $selected_permissions = array_keys($request->permissions);
        $modules_permissions = array_unique(getSystemPermissions()
            ->whereIn(
                'module_id',
                getSystemPermissions()->whereIn('id', $selected_permissions)->pluck('module_id')
            )->whereNull('model_id')->pluck('id')->toArray());
        $permissions = array_merge($selected_permissions, $modules_permissions);

        //create a new profile
        $profile = new Profile();
        $profile->is_active = $request->is_active ? true : false;
        $profile->save();

        //attach the permissions to the new profile
        $profile->permissions()->attach($permissions);

        //working on translations
        foreach ($request->translations as $translation) {
            $translation_data = [
                'name' => $translation['name']
            ];

            // insert translation if not exist
            $translation_data['language_id'] = $translation['language_id'];
            $translation_data['profile_id'] = $profile->id;

            ProfileTranslation::create($translation_data);
        }

        return $profile;
    }
}
