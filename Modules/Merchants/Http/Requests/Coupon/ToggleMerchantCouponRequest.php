<?php

namespace Modules\Merchants\Http\Requests\Coupon;

use Illuminate\Foundation\Http\FormRequest;

class ToggleMerchantCouponRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'   => 'required|exists:coupons,id,deleted_at,NULL',
            'name' => 'required|in:is_active,apply_on_cash,apply_on_card,first_order,one_time',
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
