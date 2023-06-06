<?php

namespace Modules\Website\Http\Requests\MetaPages;

use Illuminate\Validation\Rule;
use Modules\Website\Enums\PageName;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TranslationContainMainLanguage;

class UpdateMetaPageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:meta_pages,id,deleted_at,NULL',
            'page' => ['required', new Enum(PageName::class), Rule::unique('meta_pages')->whereNull('deleted_at')->ignore(request('id'))],
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

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'id' => request('id')
        ]);
    }
}
