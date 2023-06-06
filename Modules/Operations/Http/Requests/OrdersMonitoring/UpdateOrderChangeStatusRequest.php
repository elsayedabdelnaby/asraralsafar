<?php

namespace Modules\Operations\Http\Requests\OrdersMonitoring;

use Illuminate\Foundation\Http\FormRequest;
class UpdateOrderChangeStatusRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_id'=>'required|exists:orders,id,deleted_at,NULL',
            'status_id'=>'required|exists:order_status,id,deleted_at,NULL',
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
