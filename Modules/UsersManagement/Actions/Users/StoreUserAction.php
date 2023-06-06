<?php

namespace Modules\UsersManagement\Actions\Users;

use App\Models\User;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Hash;
use Modules\UsersManagement\Http\Requests\Users\StoreUserRequest;

/**
 * @purpose create a new user
 */
class StoreUserAction
{
    use FileUploadTrait;

    public function handle(StoreUserRequest $request): User
    {
        $image_profile = '';
        if ($request->hasFile('image_profile')) {
            $image_profile = $this->verifyAndUpload($request->file('image_profile'), $image_profile, 'public', 'users');
        }
        //create a new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        $user->type = $request->type;
        $user->is_active = true;
        $user->image_profile = $image_profile;
        $user->save();
        return $user;
    }
}
