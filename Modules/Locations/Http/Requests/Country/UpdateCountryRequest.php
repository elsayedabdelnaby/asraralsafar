<?php

namespace Modules\Locations\Http\Requests\Country;

use Illuminate\Validation\Rule;
use App\Rules\TranslationContainMainLanguage;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCountryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => "required|exists:countries,id",
            'code' => "required|unique:countries,phone_code," . request('id') . "|max:10|min:2",
            'currency_id' => 'required|exists:currencies,id,deleted_at,NULL',
            'flag' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'translations' => ['required', 'array', new TranslationContainMainLanguage],
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.name' => ['required', 'string', 'max:50', 'min:2', Rule::unique('country_translations')->whereNull('deleted_at')->ignore(request('id'), 'country_id')],
            'translations.*.nationality' => ['required', 'string', 'max:50', 'min:2', Rule::unique('country_translations')->whereNull('deleted_at')->ignore(request('id'), 'country_id')],
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
            'id' => request('id')
        ]);
    }
}
