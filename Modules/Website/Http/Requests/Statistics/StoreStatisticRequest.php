<?php

namespace Modules\Website\Http\Requests\Statistics;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TranslationContainMainLanguage;

class StoreStatisticRequest extends FormRequest
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
            'display_order' => 'nullable|numeric',
            'number' => 'required|numeric',
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
