<?php

namespace Modules\Locations\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class UniqueCityName implements InvokableRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private int $state_id,private ?int $city_id=null)
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

            $isCityExist = DB::table('cities')
                ->join('city_translations', 'cities.id', 'city_translations.city_id')
                ->where('cities.state_id', $this->state_id)
                ->where('city_translations.language_id', $translation['language_id'])
                ->where('city_translations.name', $translation['name'])
                ->whereNull('city_translations.deleted_at');

            if ($this->city_id) {
                $isCityExist->whereNot('city_id', $this->city_id);
            }

            $isCityExist = $isCityExist->count();

            if ($isCityExist) {
                $fail(__('locations::dashboard.the_city_name_is_already_exist'));
            }

        }
    }
}
