<?php

namespace Modules\Settings\Http\Requests\Currency;

use Illuminate\Foundation\Http\FormRequest;

class ToggleCurrencyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:currencies,id,deleted_at,NULL',
            'name' => 'required|in:is_active,is_symbol_first,is_main',
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
