<?php

namespace Modules\Merchants\Http\Requests\AdditionsProducts;

use App\Rules\TranslationContainMainLanguage;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Merchants\Rules\PriceGreaterThanDiscountPrice;
use Modules\Merchants\Rules\UniqueAdditionProductName;

class UpdateMerchantAdditionProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'=> 'required|exists:additions_products,id,deleted_at,NULL',
            'merchant_id'=> 'required|exists:merchants,id,deleted_at,NULL',
            'translations'=> ['required', 'array', new UniqueAdditionProductName(request('id')), new TranslationContainMainLanguage],
            'price'=> ['required', 'numeric'],
            'discount_price' => ['required', 'numeric', new PriceGreaterThanDiscountPrice(request('price'))],
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


    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'id'          => request('id'),
            'merchant_id' => request()->merchant_id,
        ]);
    }
}
