<?php

namespace Modules\Website\Actions\Statistics;

use Modules\Website\Entities\Statistic;
use Modules\Website\Entities\StatisticTranslation;
use Modules\Website\Http\Requests\Statistics\DeleteStatisticRequest;

/**
 * handle delete a statistic
 */
class DeleteStatisticAction
{
    public function handle(DeleteStatisticRequest $request): bool
    {
        // delete all translations of this statistic
        StatisticTranslation::where('statistic_id', $request->id)->delete();
        // delete a statistic
        $term_condition = Statistic::findOrFail($request->id);

        return $term_condition->delete();
    }
}
