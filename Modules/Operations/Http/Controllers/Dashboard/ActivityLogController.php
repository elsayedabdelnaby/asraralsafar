<?php

namespace Modules\Operations\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use Modules\Operations\Actions\ActivityLogs\FilterActivityLogsACtion;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable|array
     */
    public function index(Request $request): Renderable|array
    {
        $activities = Activity::with('causer')->paginate(20);
        return view('operations::activity_logs.indexing.index', compact('activities'));
    }
}
