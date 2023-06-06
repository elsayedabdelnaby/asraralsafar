<?php

namespace Modules\Merchants\Http\Requests\WorkingHours;

use Illuminate\Foundation\Http\FormRequest;

class MerchantWorkingHourRequest extends FormRequest
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
            'merchant_id' => request('merchant_id')
        ]);
    }
}
