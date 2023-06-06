<?php

namespace Modules\Settings\Rules;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\InvokableRule;

class UniqueCurrencyNamePerLanguage implements InvokableRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private ?int $skipped_id = null)
    {
        //
    }

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        foreach ($value as $translation) {
            $translation['language_id'];
            $query = DB::table('currencies')->join('currency_translations', 'currencies.id', '=', 'currency_translations.currency_id');

            if ($this->skipped_id) {
                $query = $query->whereNot('currencies.id', $this->skipped_id);
            }

            $exists = $query->where([
                ['currency_translations.name', $translation['name']],
                ['currency_translations.language_id', $translation['language_id']]
            ])->whereNull(['currency_translations.deleted_at', 'currencies.deleted_at'])->exists();

            if ($exists) {
                $fail(__('settings::dashboard.the_currency_name_already_exist_with_the_same_language'));
            }
        }
    }
}
