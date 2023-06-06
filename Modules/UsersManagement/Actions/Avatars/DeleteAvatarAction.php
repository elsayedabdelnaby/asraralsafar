<?php

namespace Modules\UsersManagement\Actions\Avatars;

use App\Models\User;
use Modules\UsersManagement\Entities\Avatar;
use Modules\UsersManagement\Http\Requests\Avatars\DeleteAvatarRequest;

/**
 * handle delete a blog
 */
class DeleteAvatarAction
{
    public function handle(DeleteAvatarRequest $request): bool
    {
        // delete a avatar
        $avatar = Avatar::findOrFail($request->id);
        User::where('avatar_id', $request->id)->update([
            'avatar_id' => null
        ]);
        return $avatar->delete();
    }
}
