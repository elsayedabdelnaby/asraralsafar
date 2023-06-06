<?php

namespace Modules\Merchants\Actions\WorkingHour;

use Modules\Merchants\Entities\WorkingHour;
use Modules\Merchants\Http\Requests\WorkingHours\DeleteWorkingHoursRequest;

class DeleteWorkingHoursAction
{
    public function handle(DeleteWorkingHoursRequest $request)
    {
        return WorkingHour::whereId($request->get('id'))
            ->delete();
    }
}
