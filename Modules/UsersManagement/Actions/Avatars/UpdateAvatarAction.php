<?php

namespace Modules\UsersManagement\Actions\Avatars;

use App\Traits\FileUploadTrait;
use Modules\UsersManagement\Entities\Avatar;
use Modules\UsersManagement\Http\Requests\Avatars\UpdateAvatarRequest;

/**
 * handle update an avatar condition
 */
class UpdateAvatarAction
{
    use FileUploadTrait;

    public function handle(UpdateAvatarRequest $request): Avatar
    {
        $avatar = Avatar::find($request->id);

        $image = $avatar->image ? $avatar->image : '';
        
        if ($request->hasFile('image')) {
            $image = $this->verifyAndUpload($request->file('image'), $image, 'public', 'users/avatars');
        }

        $avatar->is_active = $request->is_active ? true : false;
        $avatar->image = $image;
        $avatar->save();

        return $avatar;
    }
}
