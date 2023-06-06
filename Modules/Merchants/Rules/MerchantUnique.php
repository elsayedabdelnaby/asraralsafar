<?php

namespace Modules\Merchants\Rules;

use Closure;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use Modules\Merchants\Entities\Merchant;

class MerchantUnique implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure(string): PotentiallyTranslatedString $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail): void
    {
        $items = Merchant::WhereIn('id', $value)
            ->whereNotNull('deleted_at')
            ->get();

        $is_unique = count($value) === count(array_unique($value));

        if (!$is_unique || $items > 1)
            $fail(__('dashboard.merchant_must_be_unique_and_exist'));
    }
}
