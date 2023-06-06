<?php

namespace Modules\Locations\Actions\State;

use Modules\Locations\Entities\State;
use Modules\Locations\Services\StateService;
use Modules\Locations\Entities\StateTranslation;
use Modules\Locations\Http\Requests\State\StoreStateRequest;

class StoreStateAction
{
    /**
     * @param StoreStateRequest $request
     * @return State
     */
    public function handle(StoreStateRequest $request): State
    {
        $stateService = new StateService();
        $state = State::create($stateService->prepareAttributes($request));
        StateTranslation::insert($stateService->prepareTranslationDataToInsert($request->get('translations'), $state->id));
        return $state;
    }
}
