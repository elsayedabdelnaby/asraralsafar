<?php

namespace Modules\Operations\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

final class ContactUsMessageInputValidator extends Validator
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
            ],
            'email' => [
                'nullable',
                'email',
            ],
            'name' => ['required'],
            'title' => ['required'],
            'message' => ['required'],
        ];
    }
}
