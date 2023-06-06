<?php

namespace Modules\Website\Http\Requests\Footer\Links;

use Illuminate\Foundation\Http\FormRequest;

class ToggleFooterLinkRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:footer_links,id,deleted_at,NULL',
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
