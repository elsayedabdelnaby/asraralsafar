<?php

namespace Modules\Merchants\Actions\MerchantBranch;

use Modules\Merchants\Entities\Merchant;
use Modules\Merchants\Http\Requests\MerchantBranch\StoreMerchantBranchWithManagerRequest;
use Modules\UsersManagement\Actions\Users\StoreMerchantBranchMangerAction;

class StoreMerchantBranchWithManagerAction
{
    public function handle(StoreMerchantBranchWithManagerRequest $request)
    {
        $merchant = Merchant::find($request->get('merchant_id'));

        //Create Or Get Merchant Branch Manager
        if ($request->get('select_branch_manger') == "select_from_mangers"){
            $branch_manger_id = $request->get('merchant_branch_manger_id');
        }else{
            $branch_manger_id = (new StoreMerchantBranchMangerAction())->handle($request,$merchant->owner_id)->id;
        }

        //Create Merchant Branch Info
        (new StoreMerchantBranchAction())->handle($request,$merchant->id,$branch_manger_id);
    }
}
