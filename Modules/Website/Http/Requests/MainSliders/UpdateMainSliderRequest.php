<?php

namespace Modules\Website\Http\Requests\MainSliders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMainSliderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:main_sliders,id,deleted_at,NULL',
            'display_order' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
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
