<?php

namespace Modules\UsersManagement\Actions\Avatars;

use Modules\UsersManagement\Entities\Avatar;
use Modules\UsersManagement\Http\Requests\Avatars\ToggleAvatarRequest;

/**
 * @purpose toggle the avatar status
 */
class ToggleAvatarAction
{
    /**
     * @param ToggleAvatarRequest $request
     */
    public function handle(ToggleAvatarRequest $request): bool
    {
        $avatar = Avatar::find($request->id);
        $avatar->is_active = !$avatar->is_active;
        return $avatar->save();
    }
}
