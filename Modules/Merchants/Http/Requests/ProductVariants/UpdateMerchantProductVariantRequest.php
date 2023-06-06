<?php

namespace Modules\Merchants\Http\Requests\ProductVariants;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Merchants\Rules\CheckVariantsAttributes;

class UpdateMerchantProductVariantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'variants.*.product_attribute'=>'required|exists:product_attributes,id,deleted_at,NULL',
            'variants.*.value'=>'required|min:3|max:255',
            'variants.*.attribute_type_selected'=>'required|in:select,text',
            'variants'=>['required','array',new CheckVariantsAttributes()],
            'price'=>'required|numeric',
            'merchant_id' => 'required|exists:merchants,id,deleted_at,NULL',
            'product_id' => 'required|exists:products,id,deleted_at,NULL',
            'id'=>'required|exists:product_variants,id,deleted_at,NULL'
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
            'id'          => request('id'),
            'merchant_id' => request('merchant_id'),
            'product_id'  => request('product_id'),
        ]);
    }
}
