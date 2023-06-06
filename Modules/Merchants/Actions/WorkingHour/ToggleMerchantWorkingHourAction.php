<?php

namespace Modules\Merchants\Actions\WorkingHour;

use Modules\Merchants\Entities\WorkingHour;
use Modules\Merchants\Http\Requests\WorkingHours\ToggleMerchantWorkingHourRequest;

class ToggleMerchantWorkingHourAction
{
    public function handle(ToggleMerchantWorkingHourRequest $request)
    {
        $merchant= WorkingHour::find($request->get("id"));
        $merchant->is_active = !$merchant->is_active;
        return $merchant->save();
    }
}
