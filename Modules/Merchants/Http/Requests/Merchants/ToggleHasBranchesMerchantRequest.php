<?php

namespace Modules\Merchants\Http\Requests\Merchants;

use Illuminate\Foundation\Http\FormRequest;

class ToggleHasBranchesMerchantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'   => 'required|exists:merchants,id,deleted_at,NULL',
            'name' => 'required|in:has_branches',
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
