<?php

namespace Modules\Merchants\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class UniqueAdditionProductName implements InvokableRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private ?int $addition_product_id=null)
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
        foreach ($value as $translation) {

            $isExist = DB::table('additions_products')
                ->join('addition_product_translations', 'additions_products.id', 'addition_product_translations.addition_product_id')
                ->where('addition_product_translations.language_id', $translation['language_id'])
                ->where('addition_product_translations.name', $translation['name'])
                ->whereNull('addition_product_translations.deleted_at');

            if ($this->addition_product_id) {
                $isExist->whereNot('addition_product_id', $this->addition_product_id);
            }

            $isExist = $isExist->count();

            if ($isExist >= 1) {
                $fail(__('merchants::dashboard.the_addition_products_name_is_already_exist'));
            }
        }
    }

}
