<?php

namespace Modules\Locations\Http\Requests\City;

use Modules\Locations\Http\Requests\City\CityRequest;


class EditCityRequest extends CityRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'id' => 'required|integer|exists:states,id'
        ]);
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'id' => request('id'),
            'state_id' => request('state_id'),
            'country_id' => request('country_id'),
        ]);
    }
}
