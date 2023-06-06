<?php

namespace Modules\Merchants\Actions\Social;

use \Illuminate\Http\Request;
use Modules\Merchants\Entities\MerchantSocial;

class FilterMerchantSocialsAction
{
    public function handle(Request $request)
    {
        return MerchantSocial::where('merchant_id', $request->merchant_id);
    }
}
