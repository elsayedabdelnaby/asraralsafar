<?php

namespace Modules\UsersManagement\Actions\Users;

use App\Models\User;
use Modules\UsersManagement\Http\Requests\Users\ToggleUserRequest;

/**
 * @purpose toggle the user status
 */
class ToggleUserAction
{
    /**
     * @param ToggleUserRequest $request
     */
    public function handle(ToggleUserRequest $request): bool
    {
        $user = User::find($request->id);
        $user->is_active = !$user->is_active;
        return $user->save();
    }
}
