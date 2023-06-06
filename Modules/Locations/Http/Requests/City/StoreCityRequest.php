<?php

namespace Modules\Locations\Http\Requests\City;

use Modules\Locations\Http\Requests\City\CityRequest;


class StoreCityRequest extends CityRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return parent::rulesWithtranslations();
    }
}
