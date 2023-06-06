<?php

namespace Modules\UsersManagement\Http\Requests\Users;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:users,id,deleted_at,NULL',
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')->where(fn ($query) => $query->where([
                ['type', $this->get('type')],
                ['email', request('email')],
                ['id', '<>', $this->get('id')]
            ]))],
            'role_id' => 'required|exists:roles,id,deleted_at,NULL',
            'image_profile' => 'nullable|image|mimes:jpeg,png,jpg,svg'
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
        if (request()->routeIs('dashboard.users-management.users.update')) {
            $this->merge([
                'type' => 'admin',
                'id' => request('id')
            ]);
        } else {
            $this->merge([
                'id' => request('id')
            ]);
        }
    }
}
