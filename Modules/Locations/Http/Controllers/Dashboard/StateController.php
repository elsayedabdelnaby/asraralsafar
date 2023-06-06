<?php

namespace Modules\Locations\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Locations\Entities\State;
use Modules\Locations\Entities\Country;
use Illuminate\Contracts\Support\Renderable;
use Modules\Locations\Actions\State\StoreStateAction;
use Modules\Locations\Actions\State\DeleteStateAction;
use Modules\Locations\Actions\State\ToggleStateAction;
use Modules\Locations\Actions\State\UpdateStateAction;
use Modules\Locations\Actions\State\FilterStatesActions;
use Modules\Locations\Http\Requests\State\EditStateRequest;
use Modules\Locations\Http\Requests\State\StoreStateRequest;
use Modules\Locations\Http\Requests\State\CreateStateRequest;
use Modules\Locations\Http\Requests\State\DeleteStateRequest;
use Modules\Locations\Http\Requests\State\IndexStatesRequest;
use Modules\Locations\Http\Requests\State\ToggleStateRequest;
use Modules\Locations\Http\Requests\State\UpdateStateRequest;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(IndexStatesRequest $request)
    {
        if ($request->ajax()) {
            $states = (new FilterStatesActions())->handle($request);
            $states = $states->select([
                "states.id",
                "state_translations.name",
                "states.is_active",
                "country_translations.name as country_name",
                "states.country_id",
                DB::raw('NULL AS actions'),
                DB::raw('NULL AS cities'),

            ])->get();

            $total = count($states);

            return [
                "data" => $states,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('locations::states.indexing.index')->with([
            'country_id' => $request->get('country_id'),
            'country' => Country::findOrFail($request->get('country_id'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(CreateStateRequest $request)
    {
        return view('locations::states.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.locations.states.store', ['country_id' => $request->get('country_id')]),
                'country_id' => $request->get('country_id')
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreStateRequest $request
     * @param StoreStateAction $action
     * @return Renderable
     */
    public function store(StoreStateRequest $request, StoreStateAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.locations.states.index', ['country_id' => $request->country_id]))->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified State.
     * @param ToggleStateRequest $request
     * @param ToggleStateAction $action
     * @return Renderable
     */
    public function toggle(ToggleStateRequest $toggleRequest, ToggleStateAction $action)
    {
        try {
            $action->handle($toggleRequest);
            return response()->json([
                'status'  => 'success',
                'message' => __('locations::dashboard.the_state_toggle_was_successfully'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param EditStateRequest $request
     * @return Renderable
     */
    public function edit(EditStateRequest $request)
    {
        $state = State::find($request->get("id"));
        return view('locations::states.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.locations.states.update', ['country_id' => $state->country_id, 'id' => $request->id]),
                'state' => $state,
                'country_id' => $state->country_id,
            ]);
    }

    /**
     * @param UpdateStateRequest $request
     * @param UpdateStateAction $action
     * @return Renderable
     */
    public function update(UpdateStateRequest $request, UpdateStateAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.locations.states.index', ['country_id' => $request->get('country_id')]))->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteStateRequest $request
     * @param DeleteStateAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteStateRequest $request, DeleteStateAction $action)
    {
        return $action->handle($request);
    }
}
