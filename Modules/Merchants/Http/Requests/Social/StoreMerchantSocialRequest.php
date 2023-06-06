<?php

namespace Modules\Merchants\Http\Requests\Social;

use Illuminate\Foundation\Http\FormRequest;

class StoreMerchantSocialRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'merchant_id' =>'required|exists:merchants,id,deleted_at,NULL',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'display'=>'required|min:3|max:255',
            'url'=>'required|url|unique:merchant_social,url,NULL,id,deleted_at,NULL',
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

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    public function prepareForValidation()
    {
        $this->merge([
            'merchant_id' => request()->merchant_id,
        ]);
    }
}
