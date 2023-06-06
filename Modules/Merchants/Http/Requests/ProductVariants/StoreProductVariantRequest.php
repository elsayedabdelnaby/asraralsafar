<?php

namespace Modules\Merchants\Http\Requests\ProductVariants;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Merchants\Rules\CheckVariantsAttributes;

class StoreProductVariantRequest extends FormRequest
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
            'merchant_id' => 'required|exists:merchants,id,deleted_at,NULL',
            'product_id' => 'required|exists:products,id,deleted_at,NULL',
            'price'=>'required|numeric'
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
            'merchant_id' => request()->merchant_id,
            'product_id'=>request()->product_id
        ]);
    }
}
