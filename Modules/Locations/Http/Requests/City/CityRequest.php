<?php

namespace Modules\Locations\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Locations\Rules\UniqueCityName;
use App\Rules\TranslationContainMainLanguage;

class CityRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'state_id' => "required|exists:states,id,deleted_at,NULL",
            'country_id' => "required|exists:countries,id,deleted_at,NULL",
        ];
    }

    /**
     * Get the validation rules with translations rules that apply to the request.
     *
     * @return array
     */
    public function rulesWithtranslations()
    {
        return [
            'state_id' => "required|exists:states,id,deleted_at,NULL",
            'country_id' => "required|exists:countries,id,deleted_at,NULL",
            'translations' => [
                'required',
                'array',
                new TranslationContainMainLanguage,
                new UniqueCityName(request('state_id'), request('id'))
            ],
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.name' => ['required', 'string', 'max:50', 'min:2']
        ];
    }

    /**
     * return the toggle rules
     */
    public function toggleRules()
    {
        return [
            'id'   => 'required|exists:cities,id,deleted_at,NULL',
            'name' => 'required|in:is_active',
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
            'state_id' => request('state_id'),
            'country_id' => request('country_id'),
        ]);
    }
}
