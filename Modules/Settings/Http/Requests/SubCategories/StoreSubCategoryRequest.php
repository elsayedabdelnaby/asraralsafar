<?php

namespace Modules\Settings\Http\Requests\SubCategories;

use Modules\Settings\Entities\Category;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TranslationContainMainLanguage;
use Modules\Settings\Rules\UniqueCategoryNameAndSlugPerType;

class StoreSubCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'parent_id' => 'required|exists:categories,id,deleted_at,NULL',
            'translations' => [
                'required',
                'array',
                new TranslationContainMainLanguage,
                new UniqueCategoryNameAndSlugPerType(request('category_type_id'))
            ],
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.name' => 'required',
            'translations.*.slug' => 'required',
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

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'parent_id' => request('category_id'),
            'category_type_id' => Category::find(request('category_id'))?->category_type_id
        ]);
    }
}
