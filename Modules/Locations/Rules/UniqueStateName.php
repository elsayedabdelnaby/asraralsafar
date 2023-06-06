<?php

namespace Modules\Locations\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class UniqueStateName implements InvokableRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private int $country_id, private ?int $state_id = null)
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

            $isStateExist = DB::table('states')
                ->join('state_translations', 'states.id', 'state_translations.state_id')
                ->where('states.country_id', $this->country_id)
                ->where('state_translations.language_id', $translation['language_id'])
                ->where('state_translations.name', $translation['name'])
                ->whereNull('state_translations.deleted_at');

            if ($this->state_id) {
                $isStateExist->whereNot('state_id', $this->state_id);
            }

            $isStateExist = $isStateExist->count();

            if ($isStateExist) {
                $fail(__('locations::dashboard.the_state_name_is_already_exist'));
            }
        }
    }
}
