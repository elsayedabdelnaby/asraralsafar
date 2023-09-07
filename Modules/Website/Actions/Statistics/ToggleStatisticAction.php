<?php

namespace Modules\Website\Actions\Statistics;

use Modules\Website\Entities\Statistic;
use Modules\Website\Http\Requests\Statistics\ToggleStatisticRequest;

/**
 * @purpose toggle the Statistic status
 */
class ToggleStatisticAction
{
    /**
     * @param ToggleStatisticRequest $request
     */
    public function handle(ToggleStatisticRequest $request): bool
    {
        $term_condition = Statistic::find($request->id);
        $term_condition->is_active = !$term_condition->is_active;
        return $term_condition->save();
    }
}
