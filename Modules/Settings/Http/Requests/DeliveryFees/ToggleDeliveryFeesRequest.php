<?php

namespace Modules\Settings\Http\Requests\DeliveryFees;

use Illuminate\Foundation\Http\FormRequest;

class ToggleDeliveryFeesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:delivery_fees,id,deleted_at,NULL',
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
