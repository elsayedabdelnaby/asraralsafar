<?php

namespace Modules\Locations\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Locations\Entities\Country;
use Illuminate\Contracts\Support\Renderable;
use Modules\Locations\Actions\Countries\GetAllCountries;
use Modules\Settings\Actions\Currencies\GetAllCurrencies;
use Modules\Locations\Actions\Countries\StoreCountryAction;
use Modules\Locations\Actions\Countries\DeleteCountryAction;
use Modules\Locations\Actions\Countries\ToggleCountryAction;
use Modules\Locations\Actions\Countries\UpdateCountryAction;
use Modules\Locations\Http\Requests\Country\EditCountryRequest;
use Modules\Locations\Http\Requests\Country\StoreCountryRequest;
use Modules\Locations\Http\Requests\Country\DeleteCountryRequest;
use Modules\Locations\Http\Requests\Country\ToggleCountryRequest;
use Modules\Locations\Http\Requests\Country\UpdateCountryRequest;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $countries = (new GetAllCountries)->handle();
            $countries = $countries->select([
                'countries.id',
                'country_translations.name',
                'country_translations.nationality',
                'countries.phone_code',
                'is_active',
                DB::raw('currency_translations.name AS currency_name'),
                DB::raw('NULL AS states'),
                DB::raw('NULL AS actions')
            ])->get();
            $total = count($countries);
            return [
                'data' => $countries,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('locations::countries.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('locations::countries.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.locations.countries.store'),
                'currencies' => (new GetAllCurrencies)->handle()->active()->select('currencies.id', 'currency_translations.name')->get()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCountryRequest $request
     * @param StoreCountryAction $action
     */
    public function store(StoreCountryRequest $request, StoreCountryAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.locations.countries.index'))->with(
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
     * Toggle the specified category.
     * @param ToggleCountryRequest $request
     * @param ToggleCountryAction $action
     * @return Renderable
     */
    public function toggle(ToggleCountryRequest $toggle_request, ToggleCountryAction $action)
    {
        try {
            $action->handle($toggle_request);
            return response()->json([
                'status'  => 'success',
                'message' => __('locations::dashboard.the_country_toggle_was_successfully'),
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
     * @param EditCountryRequest $request
     * @return Renderable
     */
    public function edit(EditCountryRequest $request)
    {
        return view('locations::countries.creating_editing.form')
            ->with([
                'method'     => 'PUT',
                'action'     => route('dashboard.locations.countries.update', ['id' => $request->id]),
                'country'    => Country::find($request->get("id")),
                'currencies' => (new GetAllCurrencies)->handle()->active()->select('currencies.id', 'currency_translations.name')->get()
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param UpdateCountryRequest $request
     * @param UpdateCountryAction $action
     */
    public function update(UpdateCountryRequest $request, UpdateCountryAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.locations.countries.index'))->with(
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
     * @param DeleteCountryRequest $request
     * @param DeleteCountryAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteCountryRequest $request, DeleteCountryAction $action)
    {
        return $action->handle($request);
    }
}
