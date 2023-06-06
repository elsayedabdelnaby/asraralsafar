<?php

namespace Modules\Settings\Http\Requests\Currency;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TranslationContainMainLanguage;
use Modules\Settings\Rules\UniqueCurrencyNamePerLanguage;

class UpdateCurrencyRequest extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'iso_code' => ['required', 'min:2', 'max:10', Rule::unique('currencies', 'iso_code')->ignore($this->id)],
            'html_entity' => 'required_without:symbol',
            'symbol' => 'required_with:is_symbol_first',
            'translations' => ['required', 'array', new TranslationContainMainLanguage, new UniqueCurrencyNamePerLanguage(request('id'))],
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.name' => 'required',
        ];
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
