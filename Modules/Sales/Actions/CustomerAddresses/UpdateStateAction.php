<?php

namespace Modules\Locations\Actions\State;

use Modules\Locations\Entities\State;
use Modules\Locations\Services\StateService;
use Modules\Locations\Entities\StateTranslation;
use Modules\Locations\Http\Requests\State\UpdateStateRequest;

class UpdateStateAction
{
    public function handle(UpdateStateRequest $request): State
    {
        //update state info
        $stateService = new StateService();
        $state = State::find($request->get("id"));
        $state->update($stateService->prepareAttributes($request));

        //update state translation
        $this->updateStateTranslations($request->get('translations'), $state);
        return $state;
    }

    /**
     * take the new translations array and update the state translations
     * and remove doen't exist in new translations array
     * @param array $translations
     * @param State $state
     * @return void
     */
    private function updateStateTranslations(array $translations, State $state): void
    {
        $languagesIds = [];
        foreach ($translations as $translation) {
            $languagesIds[] = $translation['language_id'];
            StateTranslation::updateOrCreate(
                [
                    'language_id' => $translation['language_id'],
                    'state_id' => $state->id
                ],
                [
                    "name" => $translation["name"]
                ]
            );
        }

        $this->deleteDonotExistTranslationsInNew($state->translations->pluck('language_id')->toArray(), $languagesIds, $state->id);
    }

    /**
     * Take the new translations languages ids and the current
     * and delete the doesn't exist translations in new array
     * @param array $currenLanguagesIds
     * @param array $newLanguagesIds
     * @param int $stateId
     *@return boolean
     */
    private function deleteDonotExistTranslationsInNew(array $currentLanguagesIds, array $newLanguagesIds, int $stateId): bool
    {
        //Delete Not Exist Country Translations
        $deletedLanguages = array_diff($currentLanguagesIds, $newLanguagesIds);
        return StateTranslation::whereIn('language_id', $deletedLanguages)->where('state_id', $stateId)->delete();
    }
}
