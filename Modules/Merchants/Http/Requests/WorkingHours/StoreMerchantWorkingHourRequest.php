<?php

namespace Modules\Merchants\Http\Requests\WorkingHours;

use Illuminate\Foundation\Http\FormRequest;

class StoreMerchantWorkingHourRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'day' => 'required|in:saturday,sunday,monday,tuesday,wednesday,thursday,friday',
            'from' => 'required_with:to|date_format:H:i',
            'to' => 'required_with:from|after:from|date_format:H:i',
            'merchant_id' => 'required|exists:merchants,id,deleted_at,NULL',
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
        ]);
    }
}
