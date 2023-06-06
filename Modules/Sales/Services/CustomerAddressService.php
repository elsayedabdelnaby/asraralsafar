<?php

namespace Modules\Sales\Services;

use Modules\Locations\Actions\City\FilterCitiesAction;
use Modules\Locations\Actions\Countries\GetAllCountries;
use Modules\Sales\Entities\CustomerAddress;
use Modules\Sales\Http\Requests\CustomerAddresses\CreateCustomerAddressRequest;
use Modules\Sales\Http\Requests\CustomerAddresses\EditCustomerAddressRequest;
use Modules\Sales\Http\Requests\CustomerAddresses\StoreCustomerAddressRequest;
use Modules\Sales\Http\Requests\CustomerAddresses\UpdateCustomerAddressRequest;

class CustomerAddressService
{
    /**
     * Take a request and return the array of data to create a new customer address
     * @param CreateCustomerAddressRequest|$request
     * @return array
     */
    public function prepareAttributesToCreate(CreateCustomerAddressRequest $request): array
    {
        $request->request->set('country_id', 1);
        return [
            'method'      => 'POST',
            'action'      => route('dashboard.sales.customer-addresses.store', ['customer_id' => $request->get('customer_id')]),
            'customer_id' => $request->get('customer_id'),
            'countries'   => (new GetAllCountries())->handle()->select(['countries.id', 'country_translations.name'])->get()
        ];
    }

        /**
     * Take a request and return the array of data to create a new customer address
     * @param EditCustomerAddressRequest|$request
     * @return array
     */
    public function prepareAttributesToUpdate(EditCustomerAddressRequest $request): array
    {
        $request->request->set('country_id', 1);
        return  [
            'method'      => 'PUT',
            'action'      => route('dashboard.sales.customer-addresses.update', ['customer_id' => $request->get('customer_id'),'id'=>$request->get('id')]),
            'customer_id' => $request->get('customer_id'),
            'countries'   => (new GetAllCountries())->handle()->select(['countries.id', 'country_translations.name'])->get(),
            'customer_address'=>CustomerAddress::find($request->get('id'))
        ];
    }

    /**
     * Take a request and return the array of data to Store Or Update a new customer address
     * @param StoreCustomerAddressRequest|UpdateCustomerAddressRequest $request
     * @return array
     */
    public function prepareAttributesToStoreOrUpdate(StoreCustomerAddressRequest|UpdateCustomerAddressRequest $request,CustomerAddress $customerAddress=null): array
    {
        $attrs= [
            'customer_id'  => $request->get('customer_id'),
            'city_id'      => $request->get('city_id'),
            'latitude'     => $request->get('latitude'),
            'longitude'    => $request->get('longitude'),
            'phone_number' => $request->get('phone_number'),
            'address'      => $request->get('address'),
            'build_no'     => $request->get('build_no'),
            'floor_no'     => $request->get('floor_no'),
            'apartment_no' => $request->get('apartment_no'),
            'is_default'   => $request->has('is_default') ? 1 : 0
        ];

        if (!is_null($customerAddress) && $customerAddress->is_default == 1){
            $attrs['is_default']=1;
        }

        return $attrs;
    }

    public function setCustomerAddressDefaultAddress(StoreCustomerAddressRequest|UpdateCustomerAddressRequest $request, $customerAddressId): void
    {
        if (!$request->has('is_default')) {
            return;
        }
        //Now Set The Customer Address ID Is The Default And Reset
        CustomerAddress::where('customer_id', $request->get('customer_id'))->whereNotIn('id', [$customerAddressId])->update(['is_default' => 0]);
    }


}
