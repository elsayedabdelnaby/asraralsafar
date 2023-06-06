<?php

namespace Modules\Settings\Http\Requests\Currency;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TranslationContainMainLanguage;
use Modules\Settings\Rules\UniqueCurrencyNamePerLanguage;

class StoreCurrencyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //based On Currency Type We Make the Validation only for this => Symbol or Html Entity
        return [
            'iso_code' => 'required|unique:currencies,iso_code|min:2|max:10',
            'html_entity' => 'required_without:symbol',
            'symbol' => 'required_with:is_symbol_first',
            'translations' => ['required', 'array', new TranslationContainMainLanguage, new UniqueCurrencyNamePerLanguage()],
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.name' => 'required',
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
}
