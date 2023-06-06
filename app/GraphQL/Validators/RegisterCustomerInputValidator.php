<?php

namespace App\GraphQL\Validators;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Validation\Validator;

final class RegisterCustomerInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'phone' => [
                'required',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                Rule::unique('users', 'phone_number')->where(fn ($query) => $query->where([
                    ['type', 'customer'],
                    ['phone_number', $this->arg('phone')]
                ])),
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->where(fn ($query) => $query->where([
                    ['type', 'customer'],
                    ['email', $this->arg('email')]
                ])),
            ],
            'password' => ['required'],
            'device_name' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.unique' => __('dashboard.phone_number_already_exists'),
            'email.unique' => __('dashboard.email_already_exists')
        ];
    }
}
