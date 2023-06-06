<?php

namespace Modules\UsersManagement\Actions\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Modules\Merchants\Http\Requests\MerchantBranch\StoreMerchantBranchWithManagerRequest;
use Modules\Merchants\Http\Requests\MerchantBranch\UpdateMerchantBranchWithManagerRequest;
use Modules\Merchants\Http\Requests\Merchants\StoreMerchantRequest;
use Modules\UsersManagement\Http\Requests\Users\StoreMerchantOwnerRequest;

/**
 * @purpose create a new user
 */
class StoreMerchantBranchMangerAction
{
    public function handle(UpdateMerchantBranchWithManagerRequest|StoreMerchantOwnerRequest|StoreMerchantRequest|StoreMerchantBranchWithManagerRequest $request,int $report_id): User
    {
        //create a new user
        $user = new User();
        $user->name = $request->get('branch_manager_name');
        $user->email = $request->get('branch_manager_email');
        $user->phone_number=$request->get('branch_manager_phone_number');
        $user->password = Hash::make($request->get('branch_manager_password'));
        $user->type = 'branch_manager';
        $user->role_id =3;
        $user->is_active = true;
        $user->report_id = $report_id;
        $user->save();

        return $user;
    }
}
