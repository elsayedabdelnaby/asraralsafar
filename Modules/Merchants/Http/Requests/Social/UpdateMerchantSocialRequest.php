<?php

namespace Modules\Merchants\Http\Requests\Social;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMerchantSocialRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'    => 'required|integer|exists:merchant_social,id,deleted_at,NULL',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'display'=>'required|min:3',
            'url'   => 'required|url|unique:merchant_social,url,' . request('id').',id,deleted_at,NULL',
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
            'id'          => request('id'),
            'merchant_id' => request()->merchant_id, // Is this element used somewhere
        ]);
    }
}
