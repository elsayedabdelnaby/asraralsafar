<?php

namespace Modules\Merchants\Actions\WorkingHour;

use Modules\Merchants\Entities\WorkingHour;
use Modules\Merchants\Http\Requests\WorkingHours\UpdateMerchantWorkingHourRequest;
use Modules\Merchants\Services\WorkingHourService;

class UpdateMerchantWorkingHourAction
{
    public function handle(UpdateMerchantWorkingHourRequest $request)
    {
        WorkingHour::whereId($request->get('id'))
            ->update((new WorkingHourService())->prepareAttributes($request));
    }
}
