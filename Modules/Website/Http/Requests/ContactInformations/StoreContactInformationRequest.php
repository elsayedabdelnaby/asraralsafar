<?php

namespace Modules\Website\Http\Requests\ContactInformations;

use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Website\Enums\ContactInformationType;

class StoreContactInformationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validations = [
            'type' => ['required', new Enum(ContactInformationType::class)]
        ];

        if (request('type') == 'phone' || request('type') == 'whatsapp') {
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
}
