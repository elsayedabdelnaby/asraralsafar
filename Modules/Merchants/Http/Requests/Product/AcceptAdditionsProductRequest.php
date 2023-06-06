<?php

namespace Modules\Merchants\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class AcceptAdditionsProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:products,id,deleted_at,NULL',
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
            'id' => request()->id,
            'merchant_id' => request()->merchant_id,
        ]);
    }
}
