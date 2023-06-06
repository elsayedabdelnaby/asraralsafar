<?php

namespace Modules\Sales\Actions\CustomerAddresses;

use Illuminate\Http\Request;
use Modules\Sales\Entities\CustomerAddress;

class FilterCustomerAddressesAction
{
    public function handle(Request $request)
    {
        $customerAddresses = CustomerAddress::join('city_translations', 'city_translations.city_id', '=', 'customer_addresses.city_id')
            ->where('language_id', getCurrentLanguage()->id);

        if ($request->request->get('customer_id') || $request->get('customer_id')) {
            $cusotmerId = $request->request->get('customer_id') ? $request->request->get('customer_id') : $request->get('customer_id');
            $customerAddresses->where('customer_addresses.customer_id', $cusotmerId);
        }

        return $customerAddresses;
    }
}
