<?php

namespace Modules\Operations\Http\Requests\DeliveryGuys;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Operations\Rules\CheckDeliveryGuyCityIds;

class UpdateDeliveryGuyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'=>'required|exists:users,id,deleted_at,NULL',
            'name' => 'required',
            'email' => ['required','email', Rule::unique('users', 'email')->ignore($this->id)->where(fn ($query) => $query->where([
                ['type', $this->get('type')],
                ['email', request('email')]
            ]))],
            'password' => 'nullable|confirmed',
            'password_confirmation' => 'nullable',
            'phone_number' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', Rule::unique('users', 'phone_number')->ignore($this->id)->where(fn ($query) => $query->where([
                ['type', $this->get('type')],
                ['phone_number', request('phone_number')]
            ]))],
            'image_profile' => 'nullable|image|mimes:jpeg,png,jpg,svg',
            'country_id'=>'required|integer|exists:countries,id,deleted_at,NULL',
            'state_id'=>'required|integer|exists:states,id,deleted_at,NULL',
            'city_ids'=>['required','array',(new CheckDeliveryGuyCityIds())],
            'insurance_amount'=>'required|numeric',
            'exceed_amount'=>'required|numeric'
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
            'type' => 'delivery_guy',
            'id'=>request('id')
        ]);
    }
}
