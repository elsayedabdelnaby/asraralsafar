<?php

namespace Modules\Merchants\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class UniqueMerchantBranchName implements InvokableRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private ?int $merchant_branch_id=null)
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

            $isMerchantExist = DB::table('merchant_branches')
                ->join('merchant_branches_translations', 'merchant_branches.id', 'merchant_branches_translations.merchant_branch_id')
                ->where('merchant_branches_translations.language_id', $translation['language_id'])
                ->where('merchant_branches_translations.name', $translation['merchant_branch_name'])
                ->whereNull('merchant_branches_translations.deleted_at');

            if ($this->merchant_branch_id) {
                $isMerchantExist->whereNot('merchant_branch_id', $this->merchant_branch_id);
            }

            $isMerchantExist = $isMerchantExist->count();

            if ($isMerchantExist >=1) {
                $fail(__('merchants::dashboard.the_merchant_branch_name_is_already_exist'));
            }
        }
    }
}
