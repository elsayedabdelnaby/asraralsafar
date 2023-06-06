<?php

namespace Modules\Settings\Http\Requests\Tags;

use Illuminate\Foundation\Http\FormRequest;

class ToggleTagRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:tags,id,deleted_at,NULL',
            'name' => 'required|in:is_active',
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
