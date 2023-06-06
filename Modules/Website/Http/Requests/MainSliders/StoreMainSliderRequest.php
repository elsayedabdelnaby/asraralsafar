<?php

namespace Modules\Website\Http\Requests\MainSliders;

use Illuminate\Foundation\Http\FormRequest;

class StoreMainSliderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'display_order' => 'nullable|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg'
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
