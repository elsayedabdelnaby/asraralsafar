<?php

namespace Modules\Website\Actions\Statistics;

use Modules\Website\Entities\Statistic;
use Modules\Website\Entities\StatisticTranslation;
use Modules\Website\Http\Requests\Statistics\StoreStatisticRequest;

/**
 * handle create a statistic
 */
class StoreStatisticAction
{
    public function handle(StoreStatisticRequest $request): Statistic
    {
        $statistic = new Statistic();
        $statistic->is_active = $request->is_active ? true : false;
        $statistic->display_order = $request->display_order ? $request->display_order : 0;
        $statistic->number = $request->number;
        $statistic->save();
        //working on translations
        foreach ($request->translations as $translation) {
            $translation_data = [
                'title' => $translation['title'],
                'language_id' => $translation['language_id'],
                'statistic_id' => $statistic->id,
            ];

            StatisticTranslation::create($translation_data);
        }

        return $statistic;
    }
}
