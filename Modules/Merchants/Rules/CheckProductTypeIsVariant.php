<?php

namespace Modules\Merchants\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Modules\Merchants\Entities\Product;

class CheckProductTypeIsVariant implements InvokableRule
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
        $product = Product::find($value);
        if ($product->type == 'simple'){
            $fail(__('merchants::dashboard.the_product_type_is_not_suitable_to_add_variants'));
        }
    }
}
