<?php

namespace Modules\Merchants\Http\Requests\DeliveryFees;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryFeesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'=> 'required|exists:merchant_delivery_fees,id,deleted_at,NULL',
            'merchant_fees'=> 'required|numeric',
            'merchant_fees_from'=> 'required|numeric',
            'merchant_fees_to'=> 'required|numeric',
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


    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    public function prepareForValidation()
    {
        $this->merge([
            'id'          => request('id'),
            'merchant_id' => request()->merchant_id,
        ]);
    }
}
