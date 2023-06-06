<?php

namespace Modules\Sales\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class UniqueOrderStatusName implements InvokableRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private ?int $order_status_id=null)
    {
        //
    }

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        foreach ($value as $translation) {

            $isExist = DB::table('order_status')
                ->join('order_status_translations', 'order_status.id', 'order_status_translations.order_status_id')
                ->where('order_status_translations.language_id', $translation['language_id'])
                ->where('order_status_translations.name', $translation['name'])
                ->whereNull('order_status_translations.deleted_at');

            if ($this->order_status_id) {
                $isExist->whereNot('order_status_id', $this->order_status_id);
            }

            $isExist = $isExist->count();

            if ($isExist >= 1) {
                $fail(__('sales::dashboard.the_order_status_name_is_already_exist'));
            }
        }

    }

}
