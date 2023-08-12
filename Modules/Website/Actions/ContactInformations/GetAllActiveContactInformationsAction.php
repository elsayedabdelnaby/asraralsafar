<?php

namespace Modules\Website\Actions\ContactInformations;

use Illuminate\Support\Facades\DB;
use Modules\Website\Entities\ContactInformation;

/**
 * handle get all active contact information action
 */
class GetAllActiveContactInformationsAction
{
    public function handle()
    {
        return ContactInformation::select('id', 'type', 'value', 'is_active', DB::raw('null as Actions'))->active();
    }
}
