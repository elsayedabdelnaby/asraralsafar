<?php

namespace Modules\Merchants\Http\Requests\ProductAttribtues;

use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TranslationContainMainLanguage;
use Modules\Merchants\Enums\ProductAttributeType;

class StoreProductAttributeRequest extends FormRequest
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
            'translations.*.name' => 'required|string|unique:product_attribute_translations,name,NULL,id,deleted_at,NULL|min:2|max:255',
            'type' => ['required', new Enum(ProductAttributeType::class)],
            'categories_ids' => 'required|array',
            'attribute-options' => 'required_if:type,Select|array',
            'attribute-options.*.attribute-option-translations' => 'nullable|required_if:type,Select|array',
            'attribute-options.*.attribute-option-translations.*.language_id' => 'nullable|required_if:type,Select|exists:languages,id',
            'attribute-options.*.attribute-option-translations.*.name' => 'nullable|required_if:type,Select|string',
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
