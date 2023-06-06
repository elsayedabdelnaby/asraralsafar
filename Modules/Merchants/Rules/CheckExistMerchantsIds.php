<?php

namespace Modules\Merchants\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class CheckExistMerchantsIds implements InvokableRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $isExist = DB::table('merchants')->whereIn('id', $value)->count();

        if ($isExist != count($value)) {
            $fail(__('merchants::dashboard.the_merchants_is_not_exist'));
        }
    }

}
