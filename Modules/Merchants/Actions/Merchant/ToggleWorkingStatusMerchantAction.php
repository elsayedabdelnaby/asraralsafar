<?php

namespace Modules\Merchants\Actions\Merchant;

use App\Console\Commands\RedisSubscribe;
use Modules\Merchants\Entities\Merchant;
use Modules\Merchants\Http\Requests\Merchants\ToggleWorkingStatusMerchantRequest;

class ToggleWorkingStatusMerchantAction
{
    public function handle(ToggleWorkingStatusMerchantRequest $request)
    {
        $merchant= Merchant::find($request->get("id"));
        $merchant->working_status = !$merchant->working_status;
        $merchant->save();
        //Fire Working Status
        $attrs = collect($merchant)->toArray();
        $attrs['notification_type']="merchant_update_info";
        (new RedisSubscribe())->publisherToPublicChannel($attrs);
    }
}
