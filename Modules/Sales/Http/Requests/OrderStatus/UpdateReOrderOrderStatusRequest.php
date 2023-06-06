<?php

namespace Modules\Sales\Http\Requests\OrderStatus;

use App\Rules\TranslationContainMainLanguage;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Sales\Rules\UniqueOrderStatusName;

class UpdateReOrderOrderStatusRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        dd($this->request->all());
        return [
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
