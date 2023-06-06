<?php

namespace Modules\UsersManagement\Actions\Roles;

use Modules\UsersManagement\Entities\Role;
use Modules\UsersManagement\Entities\RoleTranslation;
use Modules\UsersManagement\Http\Requests\Roles\StoreRoleRequest;

/**
 * @purpose create a new role
 */
class StoreRoleAction
{
    public function handle(StoreRoleRequest $request): Role
    {
        //create a new role
        $role = new Role();
        $role->report_to = $request->report_to;
        $role->is_active = $request->is_active ? true : false;
        $role->save();
        $role->root_path = $role->reportTo->root_path . ':H' . $role->id;
        $role->save();

        //attach the profiles to the new role
        $role->profiles()->attach($request->profiles);

        //working on translations
        foreach ($request->translations as $translation) {
            $translation_data = [
                'name' => $translation['name'],
            ];

            // insert translation if not exist
            $translation_data['language_id'] = $translation['language_id'];
            $translation_data['role_id'] = $role->id;

            RoleTranslation::create($translation_data);
        }

        return $role;
    }
}
