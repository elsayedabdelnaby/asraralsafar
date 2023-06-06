<?php

namespace Modules\Merchants\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Modules\Merchants\Entities\Merchant;
use Illuminate\Contracts\Support\Renderable;
use Modules\Merchants\Services\MerchantService;
use Illuminate\Contracts\Foundation\Application;
use Modules\Merchants\Actions\Merchant\StoreMerchantAction;
use Modules\Merchants\Actions\Merchant\DeleteMerchantAction;
use Modules\Merchants\Actions\Merchant\ToggleMerchantAction;
use Modules\Merchants\Actions\Merchant\UpdateMerchantAction;
use Modules\Merchants\Actions\Merchant\FilterMerchantsAction;
use Modules\Merchants\Http\Requests\Merchants\EditMerchantRequest;
use Modules\Merchants\Http\Requests\Merchants\StoreMerchantRequest;
use Modules\Merchants\Http\Requests\Merchants\DeleteMerchantRequest;
use Modules\Merchants\Http\Requests\Merchants\ToggleMerchantRequest;
use Modules\Merchants\Http\Requests\Merchants\UpdateMerchantRequest;
use Modules\Merchants\Actions\Merchant\ToggleHasBranchesMerchantAction;
use Modules\Merchants\Actions\Merchant\ToggleWorkingStatusMerchantAction;
use Modules\Merchants\Http\Requests\Merchants\ToggleHasBranchesMerchantRequest;
use Modules\Merchants\Http\Requests\Merchants\ToggleWorkingStatusMerchantRequest;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param FilterMerchantsAction $filterMerchantsAction
     * @return Renderable|array
     */
    public function index(Request $request, FilterMerchantsAction $filterMerchantsAction): Renderable|array
    {
        if ($request->ajax()) {
            $merchants = $filterMerchantsAction->handle($request);
            $merchants = $merchants->select([
                'merchants.id',
                'merchant_translations.name',
                'merchants.order_minimum_amount',
                'merchants.reviews_count',
                'merchants.average_delivery_time',
                'merchants.maximum_distance',
                'merchants.request_status',
                'merchants.logo',
                'merchants.hot_line',
                'merchants.minimum_delivery_charges',
                'merchants.has_branches',
                'merchants.working_status',
                'merchants.is_active',
                DB::raw('NULL as merchants_branches'),
                DB::raw('NULL as merchants_working_hours'),
                DB::raw('NULL as merchants_coupons'),
                DB::raw('NULL as merchants_social'),
                DB::raw('NULL as actions'),
                DB::raw('NULL as reviews'),
                DB::raw('NULL as delivery_fees'),
                DB::raw('NULL as additions_products'),
                DB::raw('NULL as products'),
            ])->get();

            $total = count($merchants);

            return [
                'data' => $merchants,
                'recordTotal' => $total,
                'recordsFiltered' => $total
            ];
        }

        return view('merchants::merchants.indexing.index');
    }

    /**
     * return To Create Merchant View
     */
    public function create(Request $request): Factory|View|Application
    {
        $merchantService = new MerchantService();
        $options = $merchantService->getAllSelectInputsOptions($request);
        return view('merchants::merchants.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.merchants.store'),
                'merchant_types' => $options['merchantTypes'],
                'merchant_category_items' => $options['productCategories'],
                'merchant_cuisines' => $options['cuisines'],
                'merchant_meals' => $options['meals'],
                'countries' => $options['countries']
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreMerchantRequest $request Request $request
     * @param StoreMerchantAction $action
     */
    public function store(StoreMerchantRequest $request, StoreMerchantAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.index'))->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect(route('dashboard.merchants.index'))->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /*** Show the form for editing the specified resource.
     * @param EditMerchantRequest $request
     * @param $merchant_type
     * @return Renderable
     */
    public function edit(EditMerchantRequest $request): Renderable
    {
        $merchantService = new MerchantService();
        $options = $merchantService->getAllSelectInputsOptions($request);

        return view('merchants::merchants.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.merchants.update', ['id' => $request->id]),
                'merchant' => Merchant::find($request->get("id")),
                'merchant_types' => $options['merchantTypes'],
                'merchant_category_items' => $options['productCategories'],
                'merchant_cuisines' => $options['cuisines'],
                'merchant_meals' => $options['meals'],
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateMerchantRequest $request
     * @param UpdateMerchantAction $action
     */
    public function update(UpdateMerchantRequest $request, UpdateMerchantAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.index'))->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect(route('dashboard.merchants.index'))->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified Merchant.
     * @param ToggleMerchantRequest $toggle_request
     * @param ToggleMerchantAction $action
     */
    public function toggle(ToggleMerchantRequest $toggle_request, ToggleMerchantAction $action)
    {
        try {
            $action->handle($toggle_request);
            return response()->json([
                'status' => 'success',
                'message' => __('merchants::dashboard.the_merchant_toggle_was_successfully'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Toggle the specified Merchant.
     * @param ToggleHasBranchesMerchantRequest $toggle_request
     * @param ToggleHasBranchesMerchantAction $action
     */
    public function toggleHasBranches(ToggleHasBranchesMerchantRequest $toggle_request, ToggleHasBranchesMerchantAction $action)
    {
        try {
            $action->handle($toggle_request);
            return response()->json([
                'status' => 'success',
                'message' => __('merchants::dashboard.the_merchant_toggle_was_successfully'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }


    /**
     * Toggle the specified Merchant.
     * @param ToggleWorkingStatusMerchantRequest $toggle_request
     * @param ToggleWorkingStatusMerchantAction $action
     */
    public function toggleWorkingStatus(ToggleWorkingStatusMerchantRequest $toggle_request, ToggleWorkingStatusMerchantAction $action)
    {
        try {
            $action->handle($toggle_request);
            return response()->json([
                'status' => 'success',
                'message' => __('merchants::dashboard.the_merchant_toggle_was_successfully'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form to select the profile which will replace by the deleted Merchant
     * @param DeleteMerchantRequest $request
     * @param DeleteMerchantAction $action
     */
    public function delete(DeleteMerchantRequest $request, DeleteMerchantAction $action)
    {
        return $action->handle($request);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
