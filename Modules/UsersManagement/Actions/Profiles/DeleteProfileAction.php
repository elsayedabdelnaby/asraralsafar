<?php

namespace Modules\UsersManagement\Actions\Profiles;

use Modules\UsersManagement\Entities\Profile;
use Modules\UsersManagement\Entities\RoleProfile;
use Modules\UsersManagement\Entities\ProfilePermission;
use Modules\UsersManagement\Entities\ProfileTranslation;
use Modules\UsersManagement\Http\Requests\Profiles\DeleteProfileRequest;

/**
 * @purpose delete a profile
 */
class DeleteProfileAction
{
    public function handle(DeleteProfileRequest $request): bool
    {
        //replace the profile by the new profile
        RoleProfile::where('profile_id', $request->id)->update([
            'profile_id' => $request->replace_with,
        ]);

        ProfilePermission::where('profile_id', $request->id)->delete();
        ProfileTranslation::where('profile_id', $request->id)->delete();
        return Profile::findOrFail($request->id)->delete();
    }
}
