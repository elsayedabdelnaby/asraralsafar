<?php

namespace Modules\Operations\Actions\ActivityLogs;

use Spatie\Activitylog\Models\Activity;

class FilterActivityLogsACtion
{
    public function handle(array $conditions = null)
    {
        return Activity::all();
    }
}
