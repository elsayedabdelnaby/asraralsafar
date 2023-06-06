<?php

namespace Modules\Merchants\Http\Requests\ProductAttribtues;

use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TranslationContainMainLanguage;
use Modules\Merchants\Enums\ProductAttributeType;
use Modules\Merchants\Rules\CheckProductAttributeUniqueName;

class UpdateProductAttributeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'translations' => ['required', 'array', new TranslationContainMainLanguage , new CheckProductAttributeUniqueName(request('id'))],
            'translations.*.language_id' => 'required|exists:languages,id',
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

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id'=>request('id'),
        ]);
    }
}
