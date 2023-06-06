<?php

namespace App\Http\Requests\Languages;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLanguageRequest extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'code' => ['required', 'max:3', 'unique:languages,code,NULL,id,deleted_at,NULL', Rule::in(array_keys(config('laravellocalization.supportedLocales')))],
            'icon.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'direction' => [
                'required',
                Rule::in(['ltr', 'rtl']),
            ],
        ];
    }
}
