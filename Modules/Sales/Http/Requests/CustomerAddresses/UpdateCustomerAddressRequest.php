<?php

namespace Modules\Sales\Http\Requests\CustomerAddresses;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerAddressRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'=>'required|integer|exists:customer_addresses,id,deleted_at,NULL',
            'customer_id'=>'required|integer|exists:users,id,deleted_at,NULL',
            'city_id'=> "required|integer|exists:cities,id,deleted_at,NULL",
            'phone_number'=>"required|numeric",
            'address'=>'required|min:3|max:255',
            'build_no'=>'required|min:1|max:9',
            'floor_no'=>'required|string|numeric',
            'apartment_no'=>'required|min:1|max:5',
            'latitude'=>'required|numeric',
            'longitude'=>'required|numeric',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'customer_id' => request('customer_id'),
            'id'=>request('id')
        ]);
    }
}
