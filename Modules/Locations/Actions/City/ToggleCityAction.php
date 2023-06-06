<?php

namespace Modules\Locations\Actions\City;

use \Illuminate\Http\Request;
use Modules\Locations\Entities\City;
use Modules\Locations\Http\Requests\City\ToggleCityRequest;

class ToggleCityAction
{
    /**
     * toggle the status of the city
     * @param ToggleCityRequest $request
     * @return bool
     */
    public function handle(ToggleCityRequest $request): bool
    {
        $city = City::find($request->get("id"));
        $city->is_active = !$city->is_active;
        return $city->save();
    }
}
