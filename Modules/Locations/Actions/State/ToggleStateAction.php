<?php

namespace Modules\Locations\Actions\State;

use \Illuminate\Http\Request;
use Modules\Locations\Entities\State;
class ToggleStateAction
{
    public function handle(Request $request)
    {
        $state            = State::find($request->get("id"));
        $state->is_active = !$state->is_active;
        return $state->save();
    }
}
