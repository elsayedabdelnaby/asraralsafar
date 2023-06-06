<?php

namespace Modules\Merchants\Rules;

use Closure;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use Modules\Locations\Entities\City;

class CityUnique implements InvokableRule
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
        $items = City::WhereIn('id', $value)
            ->whereNotNull('deleted_at')
            ->get()
            ->count();

        $is_unique = count($value) === count(array_unique($value));

        if (!$is_unique || $items > 1)
            $fail(__('dashboard.city_must_be_unique_and_exist'));
    }
}
