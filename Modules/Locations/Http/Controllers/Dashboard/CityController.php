<?php

namespace Modules\Locations\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Locations\Entities\City;
use Modules\Locations\Entities\State;
use Illuminate\Contracts\Support\Renderable;
use Modules\Locations\Actions\City\StoreCityAction;
use Modules\Locations\Actions\City\DeleteCityAction;
use Modules\Locations\Actions\City\ToggleCityAction;
use Modules\Locations\Actions\City\UpdateCityAction;
use Modules\Locations\Actions\City\FilterCitiesAction;
use Modules\Locations\Http\Requests\City\EditCityRequest;
use Modules\Locations\Http\Requests\City\StoreCityRequest;
use Modules\Locations\Http\Requests\City\CreateCityRequest;
use Modules\Locations\Http\Requests\City\DeleteCityRequest;
use Modules\Locations\Http\Requests\City\ToggleCityRequest;
use Modules\Locations\Http\Requests\City\UpdateCityRequest;
use Modules\Locations\Http\Requests\City\IndexCitiesRequest;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(IndexCitiesRequest $request)
    {
        if ($request->ajax()) {
            $cities = (new FilterCitiesAction())->handle($request);
            $cities = $cities->select([
                "cities.id",
                "city_translations.name as name",
                "state_translations.name as state_name",
                "cities.is_active",
                DB::raw('NULL AS actions')
            ])->get();

            $total = count($cities);

            return [
                "data" => $cities,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('locations::cities.indexing.index')->with([
            'state_id' => $request->get('state_id'),
            'country_id' => $request->get('country_id'),
            'state' => State::findOrFail($request->get('state_id'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(CreateCityRequest $request)
    {
        return view('locations::cities.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.locations.cities.store', [
                    'state_id' => $request->get('state_id'),
                    'country_id' => $request->get('country_id')
                ]),
                'state_id' => $request->get('state_id'),
                'country_id' => $request->get('country_id')
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCityRequest $request
     * @param StoreCityAction $action
     * @return Renderable
     */
    public function store(StoreCityRequest $request, StoreCityAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.locations.cities.index', [
                'country_id' => $request->get('country_id'),
                'state_id' => $request->get('state_id'),
            ]))->with(
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
     * Toggle the specified City.
     * @param ToggleCityRequest $request
     * @param ToggleCityAction $action
     * @return Renderable
     */
    public function toggle(ToggleCityRequest $toggle_request, ToggleCityAction $action)
    {
        try {
            $action->handle($toggle_request);
            return response()->json([
                'status'  => 'success',
                'message' => __('locations::dashboard.the_city_toggle_was_successfully'),
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
     * @param EditCityRequest $request
     * @return Renderable
     */
    public function edit(EditCityRequest $request)
    {
        return view('locations::cities.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.locations.cities.update', [
                    'id' => $request->id,
                    'state_id' => $request->get('state_id'),
                    'country_id' => $request->get('country_id')
                ]),
                'city' => City::find($request->get("id")),
                'state_id' => $request->get('state_id'),
                'country_id' => $request->get('country_id')
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param UpdateCityRequest $request
     * @param UpdateCityAction $action
     * @return Renderable
     */
    public function update(UpdateCityRequest $request, UpdateCityAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.locations.cities.index', [
                'country_id' => $request->get('country_id'),
                'state_id' => $request->get('state_id'),
            ]))->with(
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
     * @param DeleteCityRequest $request
     * @param DeleteCityAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteCityRequest $request, DeleteCityAction $action)
    {
        return $action->handle($request);
    }
}
