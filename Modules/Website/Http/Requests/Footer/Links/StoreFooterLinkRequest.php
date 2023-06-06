<?php

namespace Modules\Website\Http\Requests\Footer\Links;

use Modules\Website\Enums\LinkType;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TranslationContainMainLanguage;

class StoreFooterLinkRequest extends FormRequest
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
            'translations.*.name' => 'required|string',
            'type' => ['required', new Enum(LinkType::class)],
            'url' => 'required|exclude_if:type,internal|url',
            'display_order' => 'nullable|numeric',
            'footer_section_id' => 'required|exists:footer_sections,id,deleted_at,NULL'
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
            'footer_section_id' => request('footer_section_id')
        ]);
    }
}
