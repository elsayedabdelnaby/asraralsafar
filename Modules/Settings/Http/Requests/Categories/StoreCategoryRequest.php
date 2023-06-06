<?php

namespace Modules\Settings\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TranslationContainMainLanguage;
use Modules\Settings\Rules\UniqueCategoryNameAndSlugPerType;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_type_id' => 'nullable|exists:category_types,id,deleted_at,NULL',
            'translations' => [
                'required',
                'array',
                new TranslationContainMainLanguage,
                new UniqueCategoryNameAndSlugPerType(request('category_type_id'))
            ],
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.name' => 'required',
            'translations.*.slug' => 'required',
            'translations.*.meta_title' => 'nullable|max:65',
            'translations.*.meta_description' => 'nullable|max:320',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'mobile_image' => 'image|mimes:jpeg,png,jpg,gif,svg'
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
