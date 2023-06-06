<?php

namespace Modules\Settings\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class ToggleCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:categories,id,deleted_at,NULL',
            'name' => 'required|in:is_active,is_active_in_mobile,is_active_in_website',
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
