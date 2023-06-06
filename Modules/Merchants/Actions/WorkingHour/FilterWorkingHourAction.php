<?php

namespace Modules\Merchants\Actions\WorkingHour;

use Modules\Merchants\Entities\WorkingHour;
use Modules\Merchants\Http\Requests\WorkingHours\MerchantWorkingHourRequest;

class FilterWorkingHourAction
{
    public function handle(MerchantWorkingHourRequest $request)
    {
        return WorkingHour::where('merchant_id',$request->merchant_id);
    }
}
