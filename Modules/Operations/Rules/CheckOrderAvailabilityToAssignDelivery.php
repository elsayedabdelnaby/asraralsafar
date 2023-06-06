<?php

namespace Modules\Operations\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Modules\Operations\Actions\OrdersMonitorIng\GetAvailableDeliveryGuysAction;

class CheckOrderAvailabilityToAssignDelivery implements InvokableRule
{


    public function __construct(private int $order_id)
    {

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
        $request = new \Illuminate\Http\Request();
        $request->request->add(['id' => $this->order_id]);
        $checkOrderAvailabilityToAssign = (new GetAvailableDeliveryGuysAction())->handle($request)->pluck('id')->toArray();

        if (!in_array($value, $checkOrderAvailabilityToAssign)) {
            $fail(__('operations::dashboard.the_check_merchant_cuisines_are_note_exist'));
        }
    }
}
