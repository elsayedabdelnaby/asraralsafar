<?php

namespace Modules\UsersManagement\Actions\Roles;

use Modules\UsersManagement\Entities\Role;

class GetAllRolesAction
{
    public function handle()
    {
        return Role::currentLanguageTranslation('roles', 'role_translations', 'role_id')
            ->get();
    }
}
