<?php

namespace Modules\UsersManagement\Actions\Roles;

use Modules\UsersManagement\Entities\Role;
use Modules\UsersManagement\Entities\RoleTranslation;
use Modules\UsersManagement\Http\Requests\Roles\UpdateRoleRequest;

/**
 * @purpose update a specific role
 */
class UpdateRoleAction
{
    public function handle(UpdateRoleRequest $request, Role $role): Role
    {
        //update a role
        $role->report_to = $request->report_to;
        $role->is_active = $request->is_active ? true : false;
        $role->root_path = $role->reportTo->root_path . ':H' . $role->id;
        $role->save();

        //sync the profiles to the new role
        $role->profiles()->sync($request->profiles);

        // update translations
        $languages_ids = [];
        foreach ($request->translations as $translation) {
            $languages_ids[] = $translation['language_id'];
            RoleTranslation::updateOrCreate(
                [
                    'language_id' => $translation['language_id'],
                    'role_id' => $role->id,
                ],
                [
                    'name' => $translation['name'],
                ]
            );
        }
        // delete not exists translations
        $deleted_languages = array_diff(
            $role->translations->pluck('language_id')->toArray(),
            $languages_ids
        );

        RoleTranslation::where('role_id', $role->id)
            ->whereIn('language_id', $deleted_languages)
            ->delete();

        return $role;
    }
}
