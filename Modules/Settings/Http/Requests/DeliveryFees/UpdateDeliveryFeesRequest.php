<?php

namespace Modules\Settings\Http\Requests\DeliveryFees;

use App\Rules\IsCompositeUnique;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryFeesRequest extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'deliver_from' => ['required', 'numeric', new IsCompositeUnique('delivery_fees', ['from' => $this->from, 'to' => $this->to])],
            'deliver_to' => 'required|numeric|unique:delivery_fees,to|gt:delivery_from',
            'fees' => 'required|numeric',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => request('id')
        ]);
    }
}
