<?php

namespace Modules\Website\Http\Requests\Services;

use Illuminate\Foundation\Http\FormRequest;

class ToggleServiceRequest extends FormRequest
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
