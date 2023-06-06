<?php

namespace Modules\Locations\Actions\City;

use Modules\Locations\Entities\City;
use Modules\Locations\Http\Requests\City\DeleteCityRequest;

/**
 * @purpose delete a city
 */
class DeleteCityAction
{
    /**
     * @param DeleteCityRequest $request
     * @return Boolean
     */
    public function handle(DeleteCityRequest $request): bool
    {
        $city = City::findOrFail($request->id);
        $city->translations()->delete();
        return $city->delete();
    }
}
