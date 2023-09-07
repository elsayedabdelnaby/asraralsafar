<?php

namespace Modules\Website\Actions\Statistics;

use Illuminate\Support\Facades\DB;
use Modules\Website\Entities\Statistic;

/**
 * handle get all active statistics
 */
class GetAllActiveStatisticsAction
{
    public function handle()
    {
        $statistics = Statistic::currentLanguageTranslation('statistics', 'statistic_translations', 'statistic_id')
            ->select(
                'statistics.id',
                'statistic_translations.title',
                'statistics.number',
                'statistics.display_order',
                'statistics.is_active',
            )->active()->orderBy('display_order');
        return $statistics->get();
    }
}
