<?php

namespace Modules\Settings\Http\Requests\CategoryTypes;

use App\Rules\TranslationContainMainLanguage;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'translations' => ['required', 'array', new TranslationContainMainLanguage],
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.name' => 'required|string|unique:category_type_translations,name,NULL,id,deleted_at,NULL',
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
