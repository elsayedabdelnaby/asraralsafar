<?php

namespace Modules\Sales\Http\Requests\CustomerAddresses;

use Illuminate\Foundation\Http\FormRequest;

class CustomerAddressesRequest extends FormRequest
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
            'customer_id' => request('customer_id')
        ]);
    }
}
