<?php

namespace Modules\UsersManagement\Actions\Avatars;

use Modules\UsersManagement\Entities\Avatar;

/**
 * handle get all active avatars
 */
class GetAllActiveAvatarsAction
{
    public function handle()
    {
        $avatars = Avatar::active();
        return $avatars;
    }
}
