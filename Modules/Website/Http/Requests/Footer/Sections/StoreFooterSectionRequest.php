<?php

namespace Modules\Website\Http\Requests\Footer\Sections;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TranslationContainMainLanguage;

class StoreFooterSectionRequest extends FormRequest
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
            'translations.*.name' => 'required|string|unique:footer_section_translations,name,NULL,id,deleted_at,NULL',
            'display_order' => 'nullable|numeric'
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
