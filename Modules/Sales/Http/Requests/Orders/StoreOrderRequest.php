<?php

namespace Modules\Sales\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Modules\Sales\Enums\PaymentMethods;

class StoreOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'merchant_id' => 'required|exists:merchants,id,deleted_at,NULL',
            'branch_id' => 'required|exists:merchant_branches,id,deleted_at,NULL',
            'customer_id' => 'required|exists:users,id,deleted_at,NULL',
            'address_id' => 'required|exists:customer_addresses,id,deleted_at,NULL',
            'delivery_id' => 'nullable|exists:users,id,deleted_at,NULL,type,delivery_guy',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id,deleted_at,NULL',
            'products.*.quantity' => 'required|numeric',
            'coupon_code' => 'nullable|exists:coupons,code,is_active,1,status,available,deleted_at,NULL',
            'payment_method' => ['nullable', new Enum(PaymentMethods::class)],
            'order_status_id'=>'required|integer|exists:order_status,id,deleted_at,NULL'
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
