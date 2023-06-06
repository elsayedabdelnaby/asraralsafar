<?php

namespace Modules\UsersManagement\Actions\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Modules\UsersManagement\Http\Requests\Users\UpdateUserPasswordRequest;

/**
 * @purpose update the user's password
 */
class UpdateUserPasswordAction
{
    /**
     * @param UpdateUserPasswordRequest $request
     */
    public function handle(UpdateUserPasswordRequest $request): bool
    {
        $user = User::find($request->id);
        $user->password = Hash::make($request->password);
        $user->remember_token = null;
        return $user->save();
    }
}
