<?php

namespace Modules\UsersManagement\Http\Requests\Users;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMerchantBranchMangerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'branch_manager_name'=>'required|unique:users,name',
            'branch_manager_phone_number'=>'required|numeric|unique:users,phone_number',
            'branch_manager_email'=>'required|unique:users,email',
            'branch_manager_password'=>'required|min:6|max:255',
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
