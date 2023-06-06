<?php

namespace Modules\Merchants\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Modules\Settings\Entities\Category;

class CheckCategoryItemsIds implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $checkCategory = Category::whereIn('id',$value)->count();

        if ($checkCategory !=count($value)) {
            $fail(__('merchants::dashboard.the_category_ids_is_not_exist'));
        }

    }
}
