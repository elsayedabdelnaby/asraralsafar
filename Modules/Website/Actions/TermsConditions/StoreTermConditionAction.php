<?php

namespace Modules\Website\Actions\TermsConditions;

use Modules\Website\Entities\TermCondition;
use Modules\Website\Entities\TermConditionTranslation;
use Modules\Website\Http\Requests\TermsConditions\StoreTermConditionRequest;

/**
 * handle create a term condition
 */
class StoreTermConditionAction
{
    public function handle(StoreTermConditionRequest $request): TermCondition
    {
        $term_condition = new TermCondition();
        $term_condition->is_active = $request->is_active ? true : false;
        $term_condition->display_order = $request->display_order ? $request->display_order : 0;
        $term_condition->save();
        //working on translations
        foreach ($request->translations as $translation) {
            $translation_data = [
                'title' => $translation['title'],
                'description' => $translation['description'],
                'language_id' => $translation['language_id'],
                'term_condition_id' => $term_condition->id,
            ];

            TermConditionTranslation::create($translation_data);
        }

        return $term_condition;
    }
}
