<?php

namespace Modules\Locations\Http\Requests\Country;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TranslationContainMainLanguage;

class StoreCountryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code'=> "required|unique:countries,phone_code|max:10|min:2",
            'currency_id' => "required|exists:currencies,id,deleted_at,NULL" ,
            'translations'=> ['required', 'array', new TranslationContainMainLanguage],
            'translations.*.language_id' => 'required|exists:languages,id',
            'flag' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'translations.*.name'=> 'required|string|unique:country_translations,name,NULL,id,deleted_at,NULL|min:2|max:50',
            'translations.*.nationality'=> 'required|string|unique:country_translations,nationality,NULL,id,deleted_at,NULL|min:2|max:50',
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
