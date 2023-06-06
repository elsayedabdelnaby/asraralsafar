<?php

namespace Modules\Sales\Http\Requests\CustomerAddresses;

use App\Http\Requests\JsonResponseRequest;

class ToggleCustomerAddressRequest extends JsonResponseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => "required|exists:users,id,deleted_at,NULL",
            'id'          => 'required|exists:customer_addresses,id,deleted_at,NULL',
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
