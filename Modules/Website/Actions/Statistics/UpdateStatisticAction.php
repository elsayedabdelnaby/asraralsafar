<?php

namespace Modules\Website\Actions\Statistics;

use Modules\Website\Entities\Statistic;
use Modules\Website\Entities\StatisticTranslation;
use Modules\Website\Http\Requests\Statistics\UpdateStatisticRequest;

/**
 * handle update a statistic
 */
class UpdateStatisticAction
{
    public function handle(UpdateStatisticRequest $request, Statistic $statistic): Statistic
    {
        $statistic->display_order = $request->display_order;
        $statistic->is_active = $request->is_active ? true : false;
        $statistic->number = $request->number;
        $statistic->save();

        // update translations
        $languages_ids = [];
        foreach ($request->translations as $translation) {
            $languages_ids[] = $translation['language_id'];
            StatisticTranslation::updateOrCreate(
                [
                    'language_id' => $translation['language_id'],
                    'statistic_id' => $statistic->id
                ],
                [
                    'title' => $translation['title'],
                ]
            );
        }
        // delete not exists translations
        $deleted_languages = array_diff($statistic->translations->pluck('language_id')->toArray(), $languages_ids);
        foreach ($deleted_languages as $language_id) {
            StatisticTranslation::where([
                ['language_id', '=', $language_id],
                ['statistic_id', '=', $statistic->id]
            ])->delete();
        }

        return $statistic;
    }
}
