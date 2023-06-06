<?php

namespace Modules\Merchants\Http\Requests\DeliveryAdjustments;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Merchants\Rules\CheckExistMerchantsIds;
use Modules\Merchants\Rules\CheckExistProductsIds;
use Modules\Merchants\Rules\CheckIfDaysIsCorrect;
use Modules\Merchants\Rules\CheckUniqueAdjustmentName;

class StoreDeliveryAdjustmentsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'day' => ['required','array',new CheckIfDaysIsCorrect()],
            'translations'=>['required','array',(new CheckUniqueAdjustmentName())],
            'start_date'=>'required|date_format:Y-m-d',
            'start_time'=>'required|date_format:H:i',
            'end_date'=>'required|after:start_date|date_format:Y-m-d',
            'end_time'=>'required|date_format:H:i',
            'minimum_order_value' => 'required|numeric',
            'maximum_order_value' => 'required|numeric',
            'minimum_shipping_cost_value' => 'required|numeric',
            'maximum_shipping_cost_value' => 'required|numeric',
            'value_type' => 'required|in:percentage,amount',
            'value' => 'required|numeric',
            'type' => 'required|in:cities,merchants,products',
            'state_id'=>'required_if:type,==,cities|exists:states,id,deleted_at,NULL',
            'city_from'=>'required_if:type,==,cities|exists:cities,id,deleted_at,NULL',
            'city_to'=>'required_if:type,==,cities|different:city_from|exists:cities,id,deleted_at,NULL',
            'merchant_ids'=>['required_if:type,==,merchants','array',(new CheckExistMerchantsIds())],
            'products_ids'=>['required_if:type,==,products','array',(new CheckExistProductsIds())],
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
