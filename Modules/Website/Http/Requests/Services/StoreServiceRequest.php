<?php

namespace Modules\Website\Http\Requests\Services;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TranslationContainMainLanguage;

class StoreServiceRequest extends FormRequest
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
            'translations.*.title' => 'required|string|max:255',
            'translations.*.slug' => 'required|string|max:255',
            'translations.*.description' => 'required|string',
            'translations.*.meta_title' => 'nullable|max:65',
            'translations.*.meta_description' => 'nullable|max:320',
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
