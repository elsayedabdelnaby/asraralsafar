<?php

namespace Modules\Locations\Http\Requests\City;

use Modules\Locations\Http\Requests\City\CityRequest;


class ToggleCityRequest extends CityRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return parent::toggleRules();
    }
}
