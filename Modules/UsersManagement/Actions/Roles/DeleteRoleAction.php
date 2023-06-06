<?php

namespace Modules\UsersManagement\Actions\Roles;

use Illuminate\Support\Facades\DB;
use Modules\UsersManagement\Entities\Role;
use Modules\UsersManagement\Entities\RoleProfile;
use Modules\UsersManagement\Entities\RoleTranslation;
use Modules\UsersManagement\Http\Requests\Roles\DeleteRoleRequest;

/**
 * @purpose delete a specific role
 */
class DeleteRoleAction
{
    public function handle(DeleteRoleRequest $request): bool
    {
        //delete the roles profiles
        $role = Role::find($request->id);
        $root_path = explode(':H' . $role->id, $role->root_path)[0];
        RoleProfile::where('role_id', $request->id)->delete();
        RoleTranslation::where('role_id', $request->id)->delete();
        DB::table('roles')
            ->where('report_to', $role->id)
            ->update([
                'report_to' => $role->report_to
            ]);

        DB::table('roles')
            ->where([
                ['id', '<>', $role->id],
                ['root_path', 'LIKE', '%' . $role->root_path . '%'],
            ])
            ->update([
                'root_path' => DB::raw("REPLACE(roles.root_path, '" . $role->root_path . "', '" . $root_path . "')"),
            ]);
        return $role->delete();
    }
}
