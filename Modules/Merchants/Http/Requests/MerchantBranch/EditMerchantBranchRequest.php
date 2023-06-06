<?php

namespace Modules\Merchants\Http\Requests\MerchantBranch;

use Illuminate\Foundation\Http\FormRequest;

class EditMerchantBranchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'=>'required|exists:merchant_branches,id,deleted_at,NULL',
            'merchant_id'=>'required|exists:merchants,id,deleted_at,NULL',
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

    protected function prepareForValidation()
    {
        $this->merge([
            'merchant_id' => request()->merchant_id,
            'id'   => request()->id,
        ]);
    }
}
