<?php

namespace Modules\Merchants\Http\Requests\ProductVariants;

use Illuminate\Foundation\Http\FormRequest;

class ToggleProductVariantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $productVariantRequest = (new ProductVariantRequest())->rules();

        $productVariantRequest['id'] = 'required|integer|exists:product_variants,id,deleted_at,NULL';

        return $productVariantRequest;
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
    protected function prepareForValidation(): void
    {
        $this->merge([
            'merchant_id' => request('merchant_id'),
            'product_id'  => request('product_id'),
        ]);
    }
}
