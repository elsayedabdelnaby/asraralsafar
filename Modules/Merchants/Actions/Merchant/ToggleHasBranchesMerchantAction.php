<?php

namespace Modules\Merchants\Actions\Merchant;

use Modules\Merchants\Entities\Merchant;
use Modules\Merchants\Http\Requests\Merchants\ToggleHasBranchesMerchantRequest;

class ToggleHasBranchesMerchantAction
{
    public function handle(ToggleHasBranchesMerchantRequest $request)
    {
        $merchant= Merchant::find($request->get("id"));
        $merchant->has_branches = !$merchant->has_branches;
        return $merchant->save();
    }
}
