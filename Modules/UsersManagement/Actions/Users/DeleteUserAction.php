<?php

namespace Modules\UsersManagement\Actions\Users;

use App\Models\User;
use Modules\UsersManagement\Http\Requests\Users\DeleteUserRequest;

/**
 * @purpose delete a user
 */
class DeleteUserAction
{
    public function handle(DeleteUserRequest $request): bool
    {
        //replace the user by the new user
        return User::findOrFail($request->id)->delete();
    }
}
