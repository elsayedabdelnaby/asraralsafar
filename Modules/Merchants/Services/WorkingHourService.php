<?php

namespace Modules\Merchants\Services;

use Modules\Merchants\Http\Requests\WorkingHours\StoreMerchantWorkingHourRequest;
use Modules\Merchants\Http\Requests\WorkingHours\UpdateMerchantWorkingHourRequest;

class WorkingHourService
{
    /**
     * Take a request and return the array of data to create|update a city
     * @param StoreMerchantWorkingHourRequest|UpdateMerchantWorkingHourRequest $request
     * @return array
     */
    public function prepareAttributes(StoreMerchantWorkingHourRequest|UpdateMerchantWorkingHourRequest $request): array
    {
        return [
            'merchant_id' => $request->get('merchant_id'),
            'day' => $request->get('day'),
            'from' => $request->get('from'),
            'to' => $request->get('to'),
            'is_active' =>$request->has('is_active') ? 1:0,
        ];
    }
}
