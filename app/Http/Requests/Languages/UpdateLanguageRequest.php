<?php

namespace App\Http\Requests\Languages;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguageRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:languages,id,deleted_at,NULL',
            'name' => 'required',
            'code' => ['required', 'max:3', Rule::unique('languages')->ignore(request('id'))->whereNull('deleted_at'), Rule::in(array_keys(config('laravellocalization.supportedLocales')))],
            'icon.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'direction' => [
                'required',
                Rule::in(['ltr', 'rtl']),
            ],
        ];
    }
}
