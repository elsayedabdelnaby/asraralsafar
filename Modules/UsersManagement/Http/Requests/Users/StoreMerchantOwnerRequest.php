<?php

namespace Modules\UsersManagement\Http\Requests\Users;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMerchantOwnerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //Start Merchant Owner Info
            'owner_name'=> 'required|min:3|max:255',
            'owner_phone_number'=> 'required|numeric|unique:users,phone_number',
            'owner_email'=> 'required|email|unique:users,email',
            'owner_password'=> 'required|min:3|max:255',
            //Start Merchant Owner Info
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
