<?php

namespace Modules\Merchants\Rules;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\InvokableRule;

class UniqueMerchantName implements InvokableRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private ?int $merchant_id = null)
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

            $isMerchantExist = DB::table('merchants')
                ->join('merchant_translations', 'merchants.id', 'merchant_translations.merchant_id')
                ->where('merchant_translations.language_id', $translation['language_id'])
                ->where('merchant_translations.name', $translation['merchant_name'])
                ->whereNull('merchant_translations.deleted_at');

            if ($this->merchant_id) {
                $isMerchantExist->whereNot('merchant_id', $this->merchant_id);
            }

            $isMerchantExist = $isMerchantExist->count();
            if ($isMerchantExist >= 1) {
                $fail(__('merchants::dashboard.the_merchant_name_is_already_exist'));
            }
        }
    }
}
