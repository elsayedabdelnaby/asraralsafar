<?php

namespace Modules\Merchants\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class CheckMerchantTypes implements InvokableRule
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
        $checkMerchantTypes = DB::table('categories')->where('category_type_id', 5)->whereIn('id', $value)->count();

        if (!$checkMerchantTypes) {
            $fail(__('merchants::dashboard.the_merchant_types_are_note_exist'));
        }
    }
}
