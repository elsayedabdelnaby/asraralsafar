<?php

namespace Modules\Merchants\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class CheckProductAttributeUniqueName implements InvokableRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private ?int $product_attribute_id = null)
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

            $isExist = DB::table('product_attribute_options')
                ->join('product_attribute_option_translations', 'product_attribute_options.id', 'product_attribute_option_translations.product_attribute_option_id')
                ->where('product_attribute_option_translations.language_id', $translation['language_id'])
                ->where('product_attribute_option_translations.name', $translation['name'])
                ->whereNull('product_attribute_options.deleted_at')
                ->whereNull('product_attribute_option_translations.deleted_at');

            if ($this->product_attribute_id) {
                $isExist->whereNot('product_attribute_options.id', $this->product_attribute_id);
            }

            $isExist = $isExist->count();
            if ($isExist >= 1) {
                $fail(__('merchants::dashboard.the_product_attribute_name_is_already_exist'));
            }
        }
    }
}
