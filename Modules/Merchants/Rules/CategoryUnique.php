<?php

namespace Modules\Merchants\Rules;

use Closure;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use Modules\Locations\Entities\City;
use Modules\Settings\Entities\Category;

class CategoryUnique implements InvokableRule
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
        $items = Category::WhereIn('id', $value)
            ->whereNotNull('deleted_at')
            ->get()
            ->count();

        $is_unique = count($value) === count(array_unique($value));

        if (!$is_unique || $items > 1)
            $fail(__('dashboard.category_must_be_unique_and_exist'));
    }
}
