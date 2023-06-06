<?php

namespace Modules\Merchants\Http\Requests\ProductVariants;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Merchants\Rules\CheckProductTypeIsVariant;

class ProductVariantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'product_id'=> ['required','integer','exists:products,id,deleted_at,NULL',new CheckProductTypeIsVariant()],
            'merchant_id' => "required|exists:merchants,id,deleted_at,NULL",
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
    protected function prepareForValidation(): void
    {
        $this->merge([
            'merchant_id'=>request('merchant_id'),
            'product_id'=>request('product_id'),
        ]);
    }
}
