<?php

namespace Modules\Merchants\Http\Requests\ProductAttribtues;

use Illuminate\Foundation\Http\FormRequest;

class CheckGetAttributeOptionsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'=>'required|exists:product_attributes,id,deleted_at,NULL',
            'product_id'=>"required|exists:products,id,deleted_at,NULL",
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

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id'=>request()->id,
            'product_id' => request()->product_id,
            'merchant_id' => request()->merchant_id,
        ]);
    }
}
