<?php

namespace Modules\Merchants\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class CheckMerchantCuisines implements InvokableRule
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
        $checkMerchantCuisines = DB::table('categories')->where('category_type_id', 7)->whereIn('id', $value)->count();

        if (!$checkMerchantCuisines) {
            $fail(__('merchants::dashboard.the_check_merchant_cuisines_are_note_exist'));
        }
    }
}
