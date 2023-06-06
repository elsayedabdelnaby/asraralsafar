<?php

namespace Modules\Website\Http\Requests\ContactInformations;

use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Website\Enums\ContactInformationType;

class UpdateContactInformationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validations = [
            'id' => 'required|exists:contact_informations,id,deleted_at,NULL',
            'type' => ['required', new Enum(ContactInformationType::class)]
        ];

        if (request('type') == 'phone') {
            $validations['value'] = 'required|regex:/^([0-9\s\-\+\(\)]*)$/';
        } else {
            $validations['value'] = 'required|email';
        }

        return $validations;
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
            'id' => request('id')
        ]);
    }
}
