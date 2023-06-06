<?php

namespace Modules\Locations\Http\Requests\State;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Locations\Rules\UniqueStateName;
use App\Rules\TranslationContainMainLanguage;

class StateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country_id' => "required|exists:countries,id,deleted_at,NULL",
        ];
    }

    public function rulesWithtranslations()
    {
        return [
            'country_id' => "required|exists:countries,id,deleted_at,NULL",
            'translations' => [
                'required',
                'array',
                new TranslationContainMainLanguage,
                new UniqueStateName(request('country_id'), request('id'))
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
            'id'   => 'required|exists:states,id,deleted_at,NULL',
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
            'country_id' => request('country_id')
        ]);
    }
}
