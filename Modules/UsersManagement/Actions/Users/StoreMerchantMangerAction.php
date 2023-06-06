<?php

namespace Modules\UsersManagement\Actions\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Modules\Merchants\Http\Requests\Merchants\StoreMerchantRequest;
use Modules\UsersManagement\Http\Requests\Users\StoreMerchantOwnerRequest;

/**
 * @purpose create a new user
 */
class StoreMerchantMangerAction
{
    public function handle(StoreMerchantOwnerRequest|StoreMerchantRequest $request): User
    {
        //create a new user
        $user = new User();
        $user->name = $request->get('owner_name');
        $user->email = $request->get('owner_email');
        $user->phone_number=$request->get('owner_phone_number');
        $user->password = Hash::make($request->get('owner_password'));
        $user->type = 'merchant_manager';
        $user->role_id =2;
        $user->is_active = true;
        $user->save();

        return $user;
    }
}
