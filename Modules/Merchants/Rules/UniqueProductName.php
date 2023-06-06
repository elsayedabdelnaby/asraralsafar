<?php

namespace Modules\Merchants\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class UniqueProductName implements InvokableRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private ?int $product_id=null)
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

            $isExist = DB::table('products')
                ->join('product_translations', 'product_translations.id', 'products.id')
                ->where('product_translations.language_id', $translation['language_id'])
                ->where('product_translations.name', $translation['name'])
                ->whereNull('product_translations.deleted_at');

            if ($this->product_id) {
                $isExist->whereNot('product_id', $this->product_id);
            }

            $isExist = $isExist->count();

            if ($isExist >= 1) {
                $fail(__('merchants::dashboard.the_products_name_is_already_exist'));
            }
        }
    }

}
