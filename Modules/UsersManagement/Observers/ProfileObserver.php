<?php

namespace Modules\UsersManagement\Observers;

use App\Services\Cache\ClearCachedAttributes;
use Modules\UsersManagement\Entities\Profile;

class ProfileObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the Profile "updated" event.
     *
     * @param  \Modules\UsersManagement\Entites\Profile  $profile
     * @return void
     */
    public function updated(Profile $profile)
    {
        ClearCachedAttributes::clear($profile->id, ['users_management_profile']);
    }


    /**
     * Handle the Profile "deleted" event.
     *
     * @param  \Modules\UsersManagement\Entites\Profile  $profile
     * @return void
     */
    public function deleted(Profile $profile)
    {
        ClearCachedAttributes::clear($profile->id, ['users_management_profile']);
    }
}
