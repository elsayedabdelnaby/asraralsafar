<?php

namespace Modules\Website\Http\Requests\Information;

use App\Rules\TranslationContainMainLanguage;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInformaitonRequest extends FormRequest
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
            'translations.*.name' => 'required',
            'main_logo' => 'nullable|max:102400|image|mimes:jpeg,png,jpg,gif,svg',
            'footer_logo' => 'nullable|max:102400|image|mimes:jpeg,png,jpg,gif,svg'
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
