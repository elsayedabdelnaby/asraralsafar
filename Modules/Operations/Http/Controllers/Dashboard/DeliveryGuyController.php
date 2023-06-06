<?php

namespace Modules\Operations\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\DB;
use Modules\Locations\Actions\Countries\GetAllCountries;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\Foundation\Application;
use Modules\Operations\Actions\DeliveryGuys\DeleteDeliveryGuyAction;
use Modules\Operations\Actions\DeliveryGuys\FilterDeliveryGuysAction;
use Modules\Operations\Actions\DeliveryGuys\StoreDeliveryGuyAction;
use Modules\Operations\Actions\DeliveryGuys\ToggleDeliveryGuyAction;
use Modules\Operations\Actions\DeliveryGuys\UpdateDeliveryGuyAction;
use Modules\Operations\Entities\DeliveryGuy;
use Modules\Operations\Http\Requests\DeliveryGuys\DeleteDeliveryGuyRequest;
use Modules\Operations\Http\Requests\DeliveryGuys\EditDeliveryGuyRequest;
use Modules\Operations\Http\Requests\DeliveryGuys\StoreDeliveryGuyRequest;
use Modules\Operations\Http\Requests\DeliveryGuys\ToggleDeliveryGuyRequest;
use Modules\Operations\Http\Requests\DeliveryGuys\UpdateDeliveryGuyRequest;


class DeliveryGuyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable|array
     */
    public function index(Request $request, FilterDeliveryGuysAction $filterDeliveryGuysAction): Renderable|array
    {
        if ($request->ajax()) {

            $deliveryGuys = $filterDeliveryGuysAction->handle();
            $deliveryGuys = $deliveryGuys->select([
                'id',
                'name',
                'email',
                'phone_number',
                'is_active',
                DB::raw('NULL AS actions')
            ])->get();

            $total = count($deliveryGuys);
            return [
                'data'            => $deliveryGuys,
                'recordsTotal'    => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('operations::delivery_guys.indexing.index');
    }

    /**
     * return To Create Merchant View
     */
    public function create(): Factory|View|Application
    {
        $countries = (new GetAllCountries())->handle()->select([
            'countries.id',
            'country_translations.name'
        ])->get();
        return view('operations::delivery_guys.creating_editing.form')
            ->with([
                'method'    => 'POST',
                'action'    => route('dashboard.operations.delivery-guys.store'),
                'countries' => $countries
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreDeliveryGuyRequest $request Request $request
     * @param StoredeliveryGuyAction $action
     */
    public function store(StoreDeliveryGuyRequest $request, StoredeliveryGuyAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.operations.delivery-guys.index'))->with(
                'success',
                __('dashboard.created_successfully')
            );
        }
        catch (Exception $e) {
            return redirect(route('dashboard.operations.delivery-guys.index'))->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /*** Show the form for editing the specified resource.
     * @param EditDeliveryGuyRequest $request
     * @return Renderable
     */
    public function edit(EditDeliveryGuyRequest $request): Renderable
    {
        $countries = (new GetAllCountries())->handle()->select([
            'countries.id',
            'country_translations.name'
        ])->get();

        return view('operations::delivery_guys.creating_editing.form')
            ->with([
                'method'=> 'PUT',
                'action'=> route('dashboard.operations.delivery-guys.update', ['id' => $request->id]),
                'deliveryGuy'=>DeliveryGuy::find($request->id),
                'countries' => $countries
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateDeliveryGuyRequest $request
     * @param UpdateDeliveryGuyAction $action
     */
    public function update(UpdateDeliveryGuyRequest $request, UpdateDeliveryGuyAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.operations.delivery-guys.index'))->with(
                'success',
                __('dashboard.updated_successfully')
            );
        }
        catch (Exception $e) {
            return redirect(route('dashboard.merchants.index'))->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified Merchant.
     * @param ToggleDeliveryGuyRequest $toggle_request
     * @param ToggleDeliveryGuyAction $action
     */
    public function toggle(ToggleDeliveryGuyRequest $toggle_request, ToggleDeliveryGuyAction $action)
    {
        try {
            $action->handle($toggle_request);
            return response()->json([
                'status'  => 'success',
                'message' => __('operations::dashboard.the_Delivery_guy_toggle_was_successfully'),
            ]);
        }
        catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form to select the profile which will replace by the deleted Merchant
     * @param DeleteDeliveryGuyRequest $request
     * @param DeleteDeliveryGuyAction $action
     */
    public function delete(DeleteDeliveryGuyRequest $request, DeleteDeliveryGuyAction $action)
    {
        return $action->handle($request);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
