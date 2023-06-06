<?php

namespace Modules\UsersManagement\Actions\Users;

use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * @purpose get all users with a specific type and status
 */
class GetAllUsersAction
{
    /**
     * @param array $conditions
     */
    public function handle(array $conditions = null)
    {
        $users = User::join('roles', 'users.role_id', '=', 'roles.id')
            ->join('role_translations', 'role_translations.role_id', '=', 'roles.id')
            ->select('users.id', 'users.name', 'email', 'users.is_active', 'users.role_id', 'users.avatar_id', 'image_profile', 'role_translations.name as role_name', DB::raw('null as Actions'))
            ->where('language_id', getCurrentLanguage()->id);

        if ($conditions) {
            $users->where($conditions);
        }

        return $users->get();
    }
}
