<?php

namespace Modules\Locations\Actions\State;

use App\Services\DeleteFile;
use Modules\Locations\Entities\State;
use Modules\Locations\Http\Requests\State\DeleteStateRequest;

/**
 * @purpose delete a state
 */
class DeleteStateAction
{
    /**
     * @param DeleteStateRequest $request
     * @return Boolean
     */
    public function handle(DeleteStateRequest $request): bool
    {
        $state = State::findOrFail($request->id);
        $state->translations()->delete();
        return $state->delete();
    }
}
