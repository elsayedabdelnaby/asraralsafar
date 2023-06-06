<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

final class UpdateCustomerNameAndAvaterValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'avatar_id' => 'required|exists:avatars,id,deleted_at,Null',
        ];
    }
}
