<?php

namespace Modules\Sales\Http\Requests\OrderStatus;

use App\Rules\TranslationContainMainLanguage;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Sales\Rules\UniqueOrderStatusName;

class StoreOrderStatusRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'translations'=>['required','array',new UniqueOrderStatusName(),new TranslationContainMainLanguage],
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
}
