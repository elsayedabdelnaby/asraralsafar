<?php

namespace Modules\UsersManagement\Actions\Avatars;

use App\Traits\FileUploadTrait;
use Modules\UsersManagement\Entities\Avatar;
use Modules\UsersManagement\Http\Requests\Avatars\StoreAvatarRequest;

/**
 * handle create a avatar
 */
class StoreAvatarAction
{
    use FileUploadTrait;

    public function handle(StoreAvatarRequest $request): Avatar
    {
        $image = '';
        if ($request->hasFile('image')) {
            $image = $this->verifyAndUpload($request->file('image'), $image, 'public', 'users/avatars');
        }

        $avatar = new Avatar();
        $avatar->is_active = $request->is_active ? true : false;
        $avatar->image = $image;
        $avatar->save();

        return $avatar;
    }
}
