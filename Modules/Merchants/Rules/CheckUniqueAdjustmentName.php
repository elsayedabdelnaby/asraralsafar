<?php

namespace Modules\Merchants\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class CheckUniqueAdjustmentName implements InvokableRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private ?int $delivery_adjustments_id=null)
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

            $isExist = DB::table('delivery_adjustments')
                ->join('delivery_adjustment_translations', 'delivery_adjustments.id', 'delivery_adjustment_translations.delivery_adjustment_id')
                ->where('delivery_adjustment_translations.language_id', $translation['language_id'])
                ->where('delivery_adjustment_translations.name', $translation['name'])
                ->whereNull('delivery_adjustment_translations.deleted_at');

            if ($this->delivery_adjustments_id) {
                $isExist->whereNot('delivery_adjustment_id', $this->delivery_adjustments_id);
            }

            $isExist = $isExist->count();

            if ($isExist >= 1) {
                $fail(__('merchants::dashboard.the_delivery_adjustment_name_is_already_exist'));
            }
        }
    }

}
