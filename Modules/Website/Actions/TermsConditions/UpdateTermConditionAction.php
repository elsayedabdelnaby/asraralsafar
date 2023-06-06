<?php

namespace Modules\Website\Actions\TermsConditions;

use Modules\Website\Entities\TermCondition;
use Modules\Website\Entities\TermConditionTranslation;
use Modules\Website\Http\Requests\TermsConditions\UpdateTermConditionRequest;

/**
 * handle update a term condition
 */
class UpdateTermConditionAction
{
    public function handle(UpdateTermConditionRequest $request, TermCondition $term_condition): TermCondition
    {
        $term_condition->display_order = $request->display_order;
        $term_condition->is_active = $request->is_active ? true : false;
        $term_condition->save();

        // update translations
        $languages_ids = [];
        foreach ($request->translations as $translation) {
            $languages_ids[] = $translation['language_id'];
            TermConditionTranslation::updateOrCreate(
                [
                    'language_id' => $translation['language_id'],
                    'term_condition_id' => $term_condition->id
                ],
                [
                    'title' => $translation['title'],
                    'description' => $translation['description']
                ]
            );
        }
        // delete not exists translations
        $deleted_languages = array_diff($term_condition->translations->pluck('language_id')->toArray(), $languages_ids);
        foreach ($deleted_languages as $language_id) {
            TermConditionTranslation::where([
                ['language_id', '=', $language_id],
                ['term_condition_id', '=', $term_condition->id]
            ])->delete();
        }

        return $term_condition;
    }
}
