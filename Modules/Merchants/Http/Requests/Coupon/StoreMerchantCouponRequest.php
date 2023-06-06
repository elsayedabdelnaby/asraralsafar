<?php

namespace Modules\Merchants\Http\Requests\Coupon;

use App\Rules\TranslationContainMainLanguage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Modules\Merchants\Enums\CouponStatus;
use Modules\Merchants\Enums\CouponType;
use Modules\Merchants\Enums\CouponValueType;
use Modules\Merchants\Rules\BranchUnique;
use Modules\Merchants\Rules\CategoryUnique;
use Modules\Merchants\Rules\CityUnique;

class StoreMerchantCouponRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|unique:coupons,code',
            'type' => ['nullable', new Enum(CouponType::class)],
            'value_type' => ['nullable', new Enum(CouponValueType::class)],
            'status' => ['nullable', new Enum(CouponStatus::class)],
            'translations' => ['required', 'array', new TranslationContainMainLanguage],
            'start_date' => 'required',
            'end_date' => 'required',
            'merchant_id' => 'nullable|exists:merchants,id,deleted_at,NULL',
            'city_id' => ['nullable', 'array', new CityUnique()],
            'branch_id' => ['nullable', 'array', new BranchUnique()],
            'category_id' => ['nullable', 'array', new CategoryUnique()],
//            'product_id' => ['nullable', 'array', new ProductUnique()],
            "value" => 'numeric|gt:0',
            "user_max_usage" => 'integer|nullable',
            "min_order" => 'integer|nullable',
            'max_order' => 'integer|gt:min_order|nullable',
            'min_shipping' => 'integer|nullable',
            'max_shipping' => 'integer|gt:min_shipping|nullable',
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
            'start_date' => date('Y-m-d h:i:s', strtotime($this->get('start_date'))),
            'end_date' => date('Y-m-d h:i:s', strtotime($this->get('start_date'))),
        ]);
    }
}
