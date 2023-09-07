<?php

namespace Modules\Website\Actions\Statistics;

use Modules\Website\Entities\Statistic;

/**
 * handle get all terms condition
 */
class GetAllStatisticsAction
{
    public function handle()
    {
        return Statistic::currentLanguageTranslation('statistics', 'statistic_translations', 'statistic_id');
    }
}
