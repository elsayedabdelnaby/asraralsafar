<?php

namespace Modules\Operations\Http\Requests\OrdersMonitoring;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Operations\Rules\CheckOrderAvailabilityToAssignDelivery;

class CheckOrderToAssignDeliveryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_id'    => 'required|exists:orders,id,deleted_at,NULL',
            'delivery_id' => ['required','exists:users,id,deleted_at,NULL',new CheckOrderAvailabilityToAssignDelivery(request('order_id'))],
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
