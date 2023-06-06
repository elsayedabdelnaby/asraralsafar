<?php

namespace Modules\Locations\Http\Requests\State;

use Modules\Locations\Http\Requests\State\StateRequest;


class UpdateStateRequest extends StateRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge([
            'id' => "required|exists:states,id",
        ], parent::rulesWithtranslations());
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
            'country_id' => request('country_id')
        ]);
    }
}
