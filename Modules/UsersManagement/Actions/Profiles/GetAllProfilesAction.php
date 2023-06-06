<?php

namespace Modules\UsersManagement\Actions\Profiles;

use Illuminate\Support\Facades\DB;
use Modules\UsersManagement\Entities\Profile;

class GetAllProfilesAction
{
    /**
     * @param boolean $withRolesCount
     * @param array $conditions
     */
    public function handle($withRolesCount = false, array $conditions = null)
    {
        $profiles = Profile::currentLanguageTranslation('profiles', 'profile_translations', 'profile_id')
            ->select('profiles.id', 'profile_translations.name', 'profiles.is_active', DB::raw('null as Actions'));

        $profiles = $withRolesCount ? $profiles->withCount('roles') : $profiles;
        if ($conditions) {
            $profiles->where([$conditions]);
        }

        return $profiles->get();
    }
}
