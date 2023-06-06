<?php

namespace Modules\UsersManagement\Http\Requests\Profiles;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\UsersManagement\Entities\Profile;

class DeleteProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:profiles,id,deleted_at,NULL',
            'replace_by' => [
                'exists:profiles,id,deleted_at,NULL',
                Rule::notIn([request('id')]),
            ],
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
