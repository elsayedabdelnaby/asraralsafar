<?php

namespace Modules\Locations\Http\Requests\State;

use Modules\Locations\Http\Requests\State\StateRequest;


class ToggleStateRequest extends StateRequest
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
