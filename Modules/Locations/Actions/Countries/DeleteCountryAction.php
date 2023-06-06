<?php

namespace Modules\Locations\Actions\Countries;

use App\Services\DeleteFile;
use Modules\Locations\Entities\Country;
use Modules\Locations\Http\Requests\Country\DeleteCountryRequest;

/**
 * @purpose delete a country
 */
class DeleteCountryAction
{
    /**
     * @param DeleteCountryRequest $request
     * @return Boolean
     */
    public function handle(DeleteCountryRequest $request): bool
    {
        $country = Country::findOrFail($request->id);
        $country->flag ? DeleteFile::delete($country->flag, 'public', 'locations') : '';
        $country->translations()->delete();
        return $country->delete();
    }
}
