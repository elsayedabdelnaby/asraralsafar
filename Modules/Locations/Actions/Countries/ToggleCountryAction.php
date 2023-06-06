<?php

namespace Modules\Locations\Actions\Countries;

use Modules\Locations\Entities\Country;
use Modules\Locations\Http\Requests\Country\ToggleCountryRequest;

class ToggleCountryAction
{
    public function handle(ToggleCountryRequest $request)
    {
        $country = Country::find($request->get("id"));
        $country->is_active = !$country->is_active;
        return $country->save();
    }
}
