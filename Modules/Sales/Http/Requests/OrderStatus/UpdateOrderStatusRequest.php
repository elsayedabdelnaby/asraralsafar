<?php

namespace Modules\Sales\Http\Requests\OrderStatus;

use App\Rules\TranslationContainMainLanguage;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Sales\Rules\UniqueOrderStatusName;

class UpdateOrderStatusRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:order_status,id,deleted_at,NULL',
            'translations'=>['required','array',new UniqueOrderStatusName(request('id')),new TranslationContainMainLanguage],
            'color'=>'required|string'
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
    protected function prepareForValidation()
    {
        $this->merge([
            'id' => request('id')
        ]);
    }
}
