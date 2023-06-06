<?php

namespace Modules\Website\Actions\TermsConditions;

use Modules\Website\Entities\TermCondition;
use Modules\Website\Entities\TermConditionTranslation;
use Modules\Website\Http\Requests\TermsConditions\DeleteTermConditionRequest;

/**
 * handle delete a term condition
 */
class DeleteTermConditionAction
{
    public function handle(DeleteTermConditionRequest $request): bool
    {
        // delete all translations of this term condition
        TermConditionTranslation::where('term_condition_id', $request->id)->delete();
        // delete a term condition
        $term_condition = TermCondition::findOrFail($request->id);

        return $term_condition->delete();
    }
}
