<?php

namespace Modules\Merchants\Http\Requests\Social;

use Illuminate\Foundation\Http\FormRequest;

class ToggleMerchantSocialRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'   => 'required|exists:merchant_social,id,deleted_at,NULL',
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
