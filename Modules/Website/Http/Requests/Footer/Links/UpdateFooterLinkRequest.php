<?php

namespace Modules\Website\Http\Requests\Footer\Links;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TranslationContainMainLanguage;

class UpdateFooterLinkRequest extends FormRequest
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
            'id' => 'required|exists:footer_links,id,deleted_at,NULL',
            'translations' => ['required', 'array', new TranslationContainMainLanguage],
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.name' => 'required|string',
            'url' => 'required|exclude_if:type,internal|url',
            'display_order' => 'nullable|numeric',
            'footer_section_id' => 'required|exists:footer_sections,id,deleted_at,NULL'
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
            'id' => request('id'),
            'footer_section_id' => request('footer_section_id')
        ]);
    }
}
