<?php

namespace Modules\Merchants\Actions\MerchantBranch;

use Modules\Merchants\Entities\MerchantBranch;
use Modules\Merchants\Http\Requests\MerchantBranch\ToggleMerchantBranchFeeRequest;

class ToggleMerchantBranchHourAction
{
    public function handle(ToggleMerchantBranchFeeRequest $request)
    {
        $merchant= MerchantBranch::find($request->get("id"));
        $merchant->is_active = !$merchant->is_active;
        return $merchant->save();
    }
}
