<?php

namespace Modules\Merchants\Http\Requests\Social;

use Illuminate\Foundation\Http\FormRequest;

class EditMerchantSocialRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'merchant_id' => "required|exists:merchants,id,deleted_at,NULL",
            'id' => 'required|integer|exists:merchant_social,id,deleted_at,NULL',
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
            'merchant_type' => request()->merchant_type // Is this element used somewhere
        ]);
    }
}
