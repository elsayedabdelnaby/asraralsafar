<?php

namespace Modules\Merchants\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Locations\Actions\Countries\GetAllCountries;
use Modules\Merchants\Actions\DeliveryAdjustment\DeleteDeliveryAdjustmentsAction;
use Modules\Merchants\Actions\DeliveryAdjustment\FilterDeliveryAdjustmentAction;
use Modules\Merchants\Actions\DeliveryAdjustment\StoreDeliveryAdjustmentsAction;
use Modules\Merchants\Actions\DeliveryAdjustment\ToggleApplyOnCashAction;
use Modules\Merchants\Actions\DeliveryAdjustment\ToggleApplyOnWalletAction;
use Modules\Merchants\Actions\DeliveryAdjustment\ToggleDeliveryAdjustmentAction;
use Modules\Merchants\Actions\DeliveryAdjustment\UpdateDeliveryAdjustmentsAction;
use Modules\Merchants\Actions\Merchant\GetAllMerchants;
use Modules\Merchants\Entities\DeliveryAdjustments;
use Illuminate\Contracts\Support\Renderable;
use Modules\Merchants\Http\Requests\DeliveryAdjustments\DeleteDeliveryAdjustmentsRequest;
use Modules\Merchants\Http\Requests\DeliveryAdjustments\EditDeliveryAdjustmentsRequest;
use Modules\Merchants\Http\Requests\DeliveryAdjustments\StoreDeliveryAdjustmentsRequest;
use Modules\Merchants\Http\Requests\DeliveryAdjustments\ToggleApplyOnCashRequest;
use Modules\Merchants\Http\Requests\DeliveryAdjustments\ToggleApplyOnWalletRequest;
use Modules\Merchants\Http\Requests\DeliveryAdjustments\ToggleDeliveryAdjustmentRequest;
use Modules\Merchants\Http\Requests\DeliveryAdjustments\UpdateDeliveryAdjustmentsRequest;

class DeliveryAdjustmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param FilterDeliveryAdjustmentAction $actions
     * @return Renderable|array
     */
    public function index(Request $request, FilterDeliveryAdjustmentAction $actions): Renderable|array
    {
        if ($request->ajax()) {
            $delivery_adjustments = $actions->handle();
            $delivery_adjustments = $delivery_adjustments->select([
                'delivery_adjustments.id',
                'delivery_adjustment_translations.name',
                'delivery_adjustments.start_date',
                'delivery_adjustments.start_time',
                'delivery_adjustments.end_date',
                'delivery_adjustments.end_time',
                'delivery_adjustments.minimum_order_value',
                'delivery_adjustments.maximum_order_value',
                'delivery_adjustments.minimum_shipping_cost_value',
                'delivery_adjustments.maximum_shipping_cost_value',
                'delivery_adjustments.type',
                'delivery_adjustments.value_type',
                'delivery_adjustments.value',
                'delivery_adjustments.apply_on_cash_on_delivery',
                'delivery_adjustments.apply_on_pay_from_wallet',
                'delivery_adjustments.is_active',
                DB::raw('NULL as actions')
            ])->get();

            $total = count($delivery_adjustments);

            return [
                'data' => $delivery_adjustments,
                'recordTotal' => $total,
                'recordsFiltered' => $total
            ];
        }
        return view('merchants::delivery_adjustments.indexing.index');
    }

    /**
     * return To Create Delivery Adjustments View
     * @return View
     */
    public function create(): View
    {

        $countries = (new GetAllCountries())->handle()->select([
            'countries.id',
            'country_translations.name'
        ])->get();

        $merchants = (new GetAllMerchants())->handle();

        return view('merchants::delivery_adjustments.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.merchants.delivery-adjustments.store'),
                'countries'=>$countries,
                'merchants'=>$merchants,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreDeliveryAdjustmentsRequest $request
     * @param StoreDeliveryAdjustmentsAction $action
     * @return Renderable|RedirectResponse
     */
    public function store(StoreDeliveryAdjustmentsRequest $request, StoreDeliveryAdjustmentsAction $action): Renderable|RedirectResponse
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.delivery-adjustments.index'))->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect(route('dashboard.merchants.delivery-adjustments.index'))->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /*** Show the form for editing the specified resource.
     * @param EditDeliveryAdjustmentsRequest $request
     * @return Renderable|View
     */
    public function edit(EditDeliveryAdjustmentsRequest $request): Renderable|View
    {
        $countries = (new GetAllCountries())->handle()->select([
            'countries.id',
            'country_translations.name'
        ])->get();

        $merchants = (new GetAllMerchants())->handle();

        return view('merchants::delivery_adjustments.creating_editing.form')
            ->with([
                'method'    => 'PUT',
                'action' => route('dashboard.merchants.delivery-adjustments.update',['id'=>$request->get('id')]),
                'countries' => $countries,
                'merchants' => $merchants,
                'delivery_adjustments'=>DeliveryAdjustments::find($request->get('id'))
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateDeliveryAdjustmentsRequest $request
     * @param UpdateDeliveryAdjustmentsAction $action
     * @return Renderable|RedirectResponse
     */
    public function update(UpdateDeliveryAdjustmentsRequest $request, UpdateDeliveryAdjustmentsAction $action): Renderable|RedirectResponse
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.delivery-adjustments.index'))->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect(route('dashboard.merchants.delivery-adjustments.index'))->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Show the form to select the profile which will replace by the deleted Merchant Social
     * @param DeleteDeliveryAdjustmentsRequest $request
     * @param DeleteDeliveryAdjustmentsAction $action
     * @return JsonResponse
     */
    public function delete(DeleteDeliveryAdjustmentsRequest $request, DeleteDeliveryAdjustmentsAction $action): JsonResponse
    {
        try {
            $action->handle($request);
            return response()->json([
                'status' => 'success',
                'message' => __('merchants::dashboard.the_merchant_delivery_adjustments_deleted'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Toggle the specified
     * @param ToggleDeliveryAdjustmentRequest $toggle_request
     * @param ToggleDeliveryAdjustmentAction $action
     * @return JsonResponse
     */
    public function toggle(ToggleDeliveryAdjustmentRequest $toggle_request, ToggleDeliveryAdjustmentAction $action): JsonResponse
    {
        try {
            $action->handle($toggle_request);
            return response()->json([
                'status' => 'success',
                    'message' => __('merchants::dashboard.the_delivery_adjustments_was_successfully'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * toggleApplyOnCash the specified
     * @param ToggleApplyOnCashRequest $toggle_request
     * @param ToggleApplyOnCashAction $action
     * @return JsonResponse
     */
    public function toggleApplyOnCash(ToggleApplyOnCashRequest $toggle_request, ToggleApplyOnCashAction $action): JsonResponse
    {
        try {
            $action->handle($toggle_request);
            return response()->json([
                'status' => 'success',
                'message' => __('merchants::dashboard.the_delivery_adjustments_was_successfully'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }


    /**
     * toggleApplyOnCash the specified
     * @param ToggleApplyOnWalletRequest $toggle_request
     * @param ToggleApplyOnWalletAction $action
     * @return JsonResponse
     */
    public function toggleApplyOnWallet(ToggleApplyOnWalletRequest $toggle_request, ToggleApplyOnWalletAction $action): JsonResponse
    {
        try {
            $action->handle($toggle_request);
            return response()->json([
                'status' => 'success',
                'message' => __('merchants::dashboard.the_delivery_adjustments_was_successfully'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

}
