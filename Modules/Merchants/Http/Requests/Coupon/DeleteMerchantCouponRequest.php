<?php

namespace Modules\Merchants\Http\Requests\Coupon;


use Illuminate\Foundation\Http\FormRequest;

class DeleteMerchantCouponRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'merchant_id' => "nullable|exists:merchants,id,deleted_at,NULL",
            'id' => 'required|integer|exists:coupons,id,deleted_at,NULL',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => request()->id,
            'merchant_id' => request()->merchant_id
        ]);
    }
}
