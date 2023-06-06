<?php

namespace Modules\Website\Http\Requests\Footer\Links;

use Illuminate\Foundation\Http\FormRequest;

class ValidateFooterSectionByIdRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'footer_section_id' => 'required|exists:footer_sections,id,deleted_at,NULL',
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
            'footer_section_id' => request('footer_section_id')
        ]);
    }
}
