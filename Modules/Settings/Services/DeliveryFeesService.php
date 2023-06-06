<?php

namespace Modules\Settings\Services;

use Illuminate\Http\Request;
class DeliveryFeesService
{

    /**
     * take store/update currency request and prepare data for currency updating/creation
     * @param Request $request
     * @return array
     */
    public static function prepareAttributes(Request $request): array
    {
        return [
            'from' => $request->get('deliver_from'),
            'to' => $request->get('deliver_to'),
            'fees' => $request->get('fees'),
            'is_active' => (bool)$request->get('is_active'),
        ];
    }
}
