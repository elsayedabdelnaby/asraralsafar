<?php

namespace Modules\Sales\Services;

use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Hash;
use Modules\Sales\Entities\Customer;
use Modules\Sales\Http\Requests\Customers\StoreCustomerRequest;
use Modules\Sales\Http\Requests\Customers\UpdateCustomerRequest;

class CustomerService
{
    use FileUploadTrait;

    /**
     * Take a request and return the array of data to create a new customer
     * @param StoreCustomerRequest $request
     * @return array
     */
    public function prepareAttributesToStore(StoreCustomerRequest $request): array
    {
        $image_profile = '';
        if ($request->hasFile('image_profile')) {
            $image_profile = $this->verifyAndUpload($request->file('image_profile'), $image_profile, 'public', 'users');
        }

        return [
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            "type" => $request->type,
            "is_active" => $request->is_active ? 1 : 0,
            "image_profile" => $image_profile,
            "phone_verified_at" => now(),
        ];
    }

    /**
     * @param UpdateCustomerRequest $request
     */
    public function preparettributesToUpdate(UpdateCustomerRequest $request): array
    {
        $image_profile = '';
        $customer = Customer::find($request->get("id"));
        $image_profile = $customer->image_profile ? $customer->image_profile : '';
        if ($request->hasFile('image_profile')) {
            $image_profile = $this->verifyAndUpload($request->file('image_profile'), $image_profile, 'public', 'users');
        }

        return [
            "name" => $request->name,
            "email" => $request->email,
            'phone_number' => $request->phone_number,
            "type" => $request->type,
            "is_active" => $request->is_active ? 1 : 0,
            "image_profile" => $image_profile
        ];
    }
}
