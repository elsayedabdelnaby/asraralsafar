<?php

namespace Modules\Merchants\Actions\WorkingHour;

use Modules\Merchants\Entities\WorkingHour;
use Modules\Merchants\Services\WorkingHourService;
use Modules\Merchants\Http\Requests\WorkingHours\StoreMerchantWorkingHourRequest;

class StoreWorkingHourAction
{
    public function handle(StoreMerchantWorkingHourRequest $request): void
    {
        WorkingHour::create((new WorkingHourService())->prepareAttributes($request));
    }
}
