<?php

namespace Modules\Merchants\Actions\Social;

use Modules\Merchants\Entities\MerchantSocial;
use Modules\Merchants\Http\Requests\Social\ToggleMerchantSocialRequest;

class ToggleMerchantSocialAction
{
    public function handle(ToggleMerchantSocialRequest $request)
    {
        $merchant = MerchantSocial::find($request->get('id'));
        $merchant->is_active = !$merchant->is_active;
        return $merchant->save();
    }
}
