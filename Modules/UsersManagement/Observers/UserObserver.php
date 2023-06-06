<?php

namespace Modules\UsersManagement\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the User "updated" event.
     *
     * @param  \Modules\UsersManagement\Entites\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }


    /**
     * Handle the User "deleted" event.
     *
     * @param  \Modules\UsersManagement\Entites\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }
}
