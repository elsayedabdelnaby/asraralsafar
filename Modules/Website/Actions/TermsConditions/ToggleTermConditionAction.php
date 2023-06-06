<?php

namespace Modules\Website\Actions\TermsConditions;

use Modules\Website\Entities\TermCondition;
use Modules\Website\Http\Requests\TermsConditions\ToggleTermConditionRequest;

/**
 * @purpose toggle the term condition status
 */
class ToggleTermConditionAction
{
    /**
     * @param ToggleTermConditionRequest $request
     */
    public function handle(ToggleTermConditionRequest $request): bool
    {
        $term_condition = TermCondition::find($request->id);
        $term_condition->is_active = !$term_condition->is_active;
        return $term_condition->save();
    }
}
