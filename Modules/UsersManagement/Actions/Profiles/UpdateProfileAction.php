<?php

namespace Modules\UsersManagement\Actions\Profiles;

use Modules\UsersManagement\Entities\Profile;
use Modules\UsersManagement\Entities\ProfileTranslation;
use Modules\UsersManagement\Http\Requests\Profiles\UpdateProfileRequest;

/**
 * @purpose update a specific profile
 */
class UpdateProfileAction
{
    public function handle(
        UpdateProfileRequest $request,
        Profile $profile
    ): Profile {
        //prepare the permissions
        $selected_permissions = array_keys($request->permissions);
        $modules_permissions = array_unique(
            getSystemPermissions()
                ->whereIn(
                    'module_id',
                    getSystemPermissions()
                        ->whereIn('id', $selected_permissions)
                        ->pluck('module_id')
                )
                ->whereNull('model_id')
                ->pluck('id')
                ->toArray()
        );
        $permissions = array_merge($selected_permissions, $modules_permissions);

        //create a new profile
        $profile->is_active = $request->is_active ? true : false;
        $profile->save();

        //attach the permissions to the new profile
        $profile->permissions()->sync($permissions);

        // update translations
        $languages_ids = [];
        foreach ($request->translations as $translation) {
            $languages_ids[] = $translation['language_id'];
            ProfileTranslation::updateOrCreate(
                [
                    'language_id' => $translation['language_id'],
                    'profile_id' => $profile->id,
                ],
                [
                    'name' => $translation['name'],
                ]
            );
        }
        // delete not exists translations
        $deleted_languages = array_diff(
            $profile->translations->pluck('language_id')->toArray(),
            $languages_ids
        );

        ProfileTranslation::where('profile_id', $profile->id)
            ->whereIn('language_id', $deleted_languages)
            ->delete();

        return $profile;
    }
}
