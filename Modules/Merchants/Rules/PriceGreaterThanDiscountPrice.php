<?php

namespace Modules\Merchants\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class PriceGreaterThanDiscountPrice implements InvokableRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private $price = null)
    {
        //
    }

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
        if (!is_null($value) && !is_null($this->price) && $this->price < intval($value)) {
            $fail(__('merchants::dashboard.the_price_should_be_greater_than_discount_price'));
        }
    }

}
