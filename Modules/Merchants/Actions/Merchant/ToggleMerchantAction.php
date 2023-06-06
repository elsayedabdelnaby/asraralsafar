<?php

namespace Modules\Merchants\Actions\Merchant;

use Modules\Merchants\Entities\Merchant;
use Modules\Merchants\Http\Requests\Merchants\ToggleMerchantRequest;

class ToggleMerchantAction
{
    public function handle(ToggleMerchantRequest $request)
    {
        $merchant= Merchant::find($request->get("id"));
        $merchant->is_active = !$merchant->is_active;
        return $merchant->save();
    }
}
