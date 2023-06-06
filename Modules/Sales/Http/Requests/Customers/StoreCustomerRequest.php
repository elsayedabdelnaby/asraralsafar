<?php

namespace Modules\Sales\Http\Requests\Customers;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => [
                'email', Rule::unique('users', 'email')->where(
                    fn ($query) => $query->where([
                        ['type', $this->get('type')],
                        ['email', request('email')]
                    ])
                )
            ],
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'phone_number' => [
                'required', 'regex:/^([0-9\s\-\+\(\)]*)$/', Rule::unique('users', 'phone_number')->where(
                    fn ($query) => $query->where([
                        ['type', $this->get('type')],
                        ['phone_number', request('phone_number')]
                    ])
                )
            ],
            'image_profile' => 'nullable|image|mimes:jpeg,png,jpg,svg'
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
            'type' => 'customer'
        ]);
    }
}
