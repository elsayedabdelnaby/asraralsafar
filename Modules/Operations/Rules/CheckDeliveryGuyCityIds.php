<?php

namespace Modules\Operations\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class CheckDeliveryGuyCityIds implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $checkCityIds = DB::table('cities')
                            ->whereIn('id', $value)
                            ->where('is_active', 1)
                            ->whereNull('deleted_at')
                            ->count();

        if ($checkCityIds !=count($value)){
            $fail(__('operations::dashboard.the_check_merchant_cuisines_are_note_exist'));
        }
    }
}
