<?php

namespace Modules\Merchants\Actions\MerchantBranch;

use Modules\Merchants\Entities\MerchantBranch;
use Modules\Merchants\Http\Requests\MerchantBranch\DeleteMerchantBranchRequest;

class DeleteMerchantBranchAction
{
    public function handle(DeleteMerchantBranchRequest $request)
    {
        $merchant =  MerchantBranch::find($request->get("id"));
        $merchant->translations()->delete();
        $merchant->delete();
    }
}
