<?php

namespace Modules\Merchants\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class CheckIfDaysIsCorrect implements InvokableRule
{

    /**'
     * @var string[] WeekDaysName
     */
    private $week_days = [
        'saturday',
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday'
    ];

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        foreach ($value as $item) {
            if (!in_array($item, $this->week_days)) {
                $fail(__('merchants::dashboard.the_day_name_is_not_exist'));
            }
        }
    }
}
