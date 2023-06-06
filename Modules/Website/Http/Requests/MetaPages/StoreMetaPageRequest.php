<?php

namespace Modules\Website\Http\Requests\MetaPages;

use Modules\Website\Enums\PageName;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TranslationContainMainLanguage;

class StoreMetaPageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'page' => ['required', 'unique:meta_pages,page,NULL,id,deleted_at,NULL', new Enum(PageName::class)],
            'translations' => ['required', 'array', new TranslationContainMainLanguage],
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.title' => 'required|max:65',
            'translations.*.description' => 'required|max:320',
            'image' => 'image|mimes:jpeg,png,jpg'
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
