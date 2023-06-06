<?php

namespace Modules\UsersManagement\Observers;

use Modules\UsersManagement\Entities\Role;
use App\Services\Cache\ClearCachedAttributes;

class RoleObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the role "updated" event.
     *
     * @param  \Modules\UsersManagement\Entites\Role  $role
     * @return void
     */
    public function updated(Role $role)
    {
        ClearCachedAttributes::clear($role->id, ['users_management_role']);
    }


    /**
     * Handle the role "deleted" event.
     *
     * @param  \Modules\UsersManagement\Entites\Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        ClearCachedAttributes::clear($role->id, ['users_management_role']);
    }
}
