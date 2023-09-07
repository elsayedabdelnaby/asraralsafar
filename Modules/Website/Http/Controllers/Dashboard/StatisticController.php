<?php

namespace Modules\Website\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Modules\Website\Entities\Statistic;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\Statistics\StoreStatisticAction;
use Modules\Website\Actions\Statistics\DeleteStatisticAction;
use Modules\Website\Actions\Statistics\ToggleStatisticAction;
use Modules\Website\Actions\Statistics\UpdateStatisticAction;
use Modules\Website\Actions\Statistics\GetAllStatisticsAction;
use Modules\Website\Http\Requests\Statistics\EditStatisticRequest;
use Modules\Website\Http\Requests\Statistics\StoreStatisticRequest;
use Modules\Website\Http\Requests\Statistics\DeleteStatisticRequest;
use Modules\Website\Http\Requests\Statistics\ToggleStatisticRequest;
use Modules\Website\Http\Requests\Statistics\UpdateStatisticRequest;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $statistics = (new GetAllStatisticsAction)->handle();
            $statistics = $statistics->select([
                'statistics.id',
                'title',
                'number',
                'display_order',
                'is_active',
                DB::raw('NULL AS Actions')
            ])->get();
            $total = count($statistics);
            return [
                'data' => $statistics,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('website::statistics.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        return view('website::statistics.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.website.statistics.store'),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreStatisticRequest $request
     * @param StoreStatisticAction $action
     * @return Renderable
     */
    public function store(StoreStatisticRequest $request, StoreStatisticAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/website/statistics')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/statistics')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified privacy policy.
     * @param ToggleStatisticRequest $request
     * @param ToggleStatisticAction $action
     * @param int $id
     * @return Renderable
     */
    public function toggle(ToggleStatisticRequest $toggle_request, ToggleStatisticAction $action)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('website::dashboard.the_statistic_toggle_was_successfully'),
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ]
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param EditStatisticRequest $request
     * @param int $id
     * @return Renderable
     */
    public function edit(EditStatisticRequest $request)
    {
        return view('website::statistics.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.website.statistics.update', ['id' => $request->id]),
                'statistic' => Statistic::find($request->id),
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateStatisticRequest $request
     * @param UpdateStatisticAction $action
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateStatisticRequest $request, UpdateStatisticAction $action)
    {
        try {
            $action->handle($request, Statistic::findOrFail($request->id));
            return redirect('dashboard/website/statistics')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/statistics')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteStatisticRequest $request
     * @param DeleteStatisticAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteStatisticRequest $request, DeleteStatisticAction $action)
    {
        return $action->handle($request);
    }
}
