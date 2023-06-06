<?php

namespace Modules\Operations\Services;

use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Hash;
use Modules\Operations\Entities\DeliveryGuy;
use Modules\Operations\Http\Requests\DeliveryGuys\StoreDeliveryGuyRequest;
use Modules\Operations\Http\Requests\DeliveryGuys\UpdateDeliveryGuyRequest;

class DeliveryGuyService
{
    use FileUploadTrait;

    /**
     * Take a request and return the array of data to create|update a delivery Guy`
     * @param StoreDeliveryGuyRequest|UpdateDeliveryGuyRequest $request
     * @return array
     */
    public function prepareAttributes(StoreDeliveryGuyRequest|UpdateDeliveryGuyRequest $request): array
    {
        $image_profile = '';
        if ($request->hasFile('image_profile')) {
            $image_profile = $this->verifyAndUpload($request->file('image_profile'), $image_profile, 'public', 'users');
        }

        $attrs = [
            "name"              => $request->get('name'),
            "email"             => $request->get('email'),
            "type"              => $request->get('type'),
            'phone_number'      => $request->get('phone_number'),
            "is_active"         => $request->is_active ? 1 : 0,
            "image_profile"     => $image_profile,
            "phone_verified_at" => now(),
        ];

        if (!is_null($request->get('password'))) {
            $attrs['password'] = Hash::make($request->get('password'));
        }
        return $attrs;
    }

    /**
     * Take a request and return the array of data to create|update a delivery Guy Cities
     * @param StoreDeliveryGuyRequest|UpdateDeliveryGuyRequest $request
     * @return array
     */
    public function prepareDeliveryGuyCities(StoreDeliveryGuyRequest|UpdateDeliveryGuyRequest $request, $deliveryGuyId): array
    {
        $attrsToInsert = [];
        foreach ($request->get('city_ids') as $cityId) {
            $attrsToInsert[] = [
                'city_id'    => $cityId,
                'user_id'    => $deliveryGuyId,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        return $attrsToInsert;
    }

    /**
     * @param StoreDeliveryGuyRequest|UpdateDeliveryGuyRequest $request
     * @return void
     */
    public function prepareDeliveryGuyAttributes(StoreDeliveryGuyRequest|UpdateDeliveryGuyRequest $request,DeliveryGuy $deliveryGuy): array
    {
        return [
            'user_id'          => $deliveryGuy->id,
            'insurance_amount' => $request->get('insurance_amount'),
            'allow_to_exceed'  => $request->allow_to_exceed ? 1 : 0,
            'exceed_amount'    => $request->get('exceed_amount'),
        ];
    }
}
