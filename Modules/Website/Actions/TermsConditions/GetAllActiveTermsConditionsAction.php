<?php

namespace Modules\Website\Actions\TermsConditions;

use Illuminate\Support\Facades\DB;
use Modules\Website\Entities\TermCondition;

/**
 * handle get all active terms condtions
 */
class GetAllActiveTermsConditionsAction
{
    public function handle()
    {
        $terms_conditions = TermCondition::currentLanguageTranslation('terms_conditions', 'term_condition_translations', 'term_condition_id')
            ->select(
                'terms_conditions.id',
                'term_condition_translations.title',
                'term_condition_translations.description',
                'terms_conditions.display_order',
                'terms_conditions.is_active',
                DB::raw('null as Actions')
            )->active();
        return $terms_conditions->get();
    }
}
