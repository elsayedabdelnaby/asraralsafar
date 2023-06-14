<?php

namespace Modules\Website\Http\Requests\Blogs;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TranslationContainMainLanguage;

class StoreBlogRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'category_id' => 'required|exists:categories,id,deleted_at,NULL',
            'translations' => ['required', 'array', new TranslationContainMainLanguage],
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.slug' => 'required|string|max:255',
            'translations.*.short_description' => 'required|string|max:255',
            'translations.*.description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg'
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
