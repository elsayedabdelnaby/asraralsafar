<?php

namespace Modules\Website\Http\Requests\Services;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TranslationContainMainLanguage;

class UpdateServiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:services,id,deleted_at,NULL',
            'translations' => ['required', 'array', new TranslationContainMainLanguage],
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.slug' => 'required|string|max:255',
            'translations.*.description' => 'required',
            'translations.*.meta_title' => 'nullable|max:65',
            'translations.*.meta_description' => 'nullable|max:320',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
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
