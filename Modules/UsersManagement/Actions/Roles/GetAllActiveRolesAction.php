<?php

namespace Modules\UsersManagement\Actions\Roles;

use Modules\UsersManagement\Entities\Role;

class GetAllActiveRolesAction
{
    public function handle()
    {
        return Role::currentLanguageTranslation('roles', 'role_translations', 'role_id')
            ->active()->select('roles.id', 'role_translations.name')->get();
    }
}
