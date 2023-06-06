<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class TranslationContainMainLanguage implements InvokableRule
{
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
        $exists = false;
        $mainLanguage = getMainLanguage();
        if (count($value) > 2) {
            $fail(__('dashboard.can_not_add_more_than_two_translations'));
        }

        foreach ($value as $translation) {
            if ($translation['language_id'] == $mainLanguage->id) {
                $exists = true;
                break;
            }
        }

        if (!$exists) {
            $fail(__('dashboard.the_translations_must_contains_the') . ' ' . $mainLanguage->name);
        }
    }
}
