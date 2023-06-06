<?php

namespace Modules\Merchants\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class CheckMerchantCategoryItems implements InvokableRule
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
        $checkMerchantCategoryItems = DB::table('categories')->where('category_type_id', 1)->whereIn('id', $value)->count();

        if (!$checkMerchantCategoryItems) {
            $fail(__('merchants::dashboard.the_merchant_category_items_are_note_exist'));
        }
    }
}
