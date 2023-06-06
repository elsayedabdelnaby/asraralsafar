<?php

namespace Modules\Merchants\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Merchants\Actions\AdditionsProduct\DeleteAdditionProductAction;
use Modules\Merchants\Actions\AdditionsProduct\FilterAdditionsProductsAction;
use Modules\Merchants\Actions\AdditionsProduct\StoreAdditionsProductAction;
use Modules\Merchants\Actions\AdditionsProduct\ToggleMerchantAdditionProductAction;
use Modules\Merchants\Actions\AdditionsProduct\UpdateMerchantAdditionProductAction;
use Modules\Merchants\Entities\AdditionProduct;
use Modules\Merchants\Entities\Merchant;
use Illuminate\Contracts\Support\Renderable;
use Modules\Merchants\Http\Requests\AdditionsProducts\CreateMerchantAdditionsProductsRequest;
use Modules\Merchants\Http\Requests\AdditionsProducts\DeleteAdditionProductRequest;
use Modules\Merchants\Http\Requests\AdditionsProducts\EditMerchantAdditionProductRequest;
use Modules\Merchants\Http\Requests\AdditionsProducts\MerchantAdditionsProductsRequest;
use Modules\Merchants\Http\Requests\AdditionsProducts\StoreMerchantAdditionsProductRequest;
use Modules\Merchants\Http\Requests\AdditionsProducts\ToggleMerchanAdditionProductRequest;
use Modules\Merchants\Http\Requests\AdditionsProducts\UpdateMerchantAdditionProductRequest;

class AdditionsProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param MerchantAdditionsProductsRequest $request
     * @param FilterAdditionsProductsAction $actions
     * @return Renderable|array
     */
    public function index(MerchantAdditionsProductsRequest $request, FilterAdditionsProductsAction $actions): Renderable|array
    {

        if ($request->ajax()) {
            $additions_products = $actions->handle($request);
            $additions_products = $additions_products->select([
                'additions_products.id',
                'addition_product_translations.name',
                'additions_products.price',
                'additions_products.discount_price',
                'additions_products.is_active',
                DB::raw('NULL as actions')
            ])->get();

            $total = count($additions_products);

            return [
                'data' => $additions_products,
                'recordTotal' => $total,
                'recordsFiltered' => $total
            ];
        }

        $merchant = Merchant::find($request->merchant_id);

        return view('merchants::additions_products.indexing.index', [
            'merchant' => $merchant,
        ]);
    }

    /**
     * return To Create Merchant-additions-products View
     * @param CreateMerchantAdditionsProductsRequest $request
     * @return View
     */
    public function create(CreateMerchantAdditionsProductsRequest $request): View
    {
        return view('merchants::additions_products.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.merchants.additions-products.store', ['merchant_id' => $request->merchant_id]),
                'merchant' => Merchant::find($request->merchant_id),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreMerchantAdditionsProductRequest $request
     * @param StoreAdditionsProductAction $action
     * @return Renderable|RedirectResponse
     */
    public function store(StoreMerchantAdditionsProductRequest $request, StoreAdditionsProductAction $action): Renderable|RedirectResponse
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.additions-products.index', ['merchant_id' => $request->merchant_id]))->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect(route('dashboard.merchants.additions-products.index', ['merchant_id' => $request->merchant_id]))->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /*** Show the form for editing the specified resource.
     * @param EditMerchantAdditionProductRequest $request
     * @return Renderable|View
     */
    public function edit(EditMerchantAdditionProductRequest $request): Renderable|View
    {
        return view('merchants::additions_products.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.merchants.additions-products.update', ['merchant_id' => $request->merchant_id, 'id' => $request->id]),
                'merchant' => Merchant::find($request->merchant_id),
                'merchant_additions_product' => AdditionProduct::find($request->id)
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateMerchantAdditionProductRequest $request
     * @param UpdateMerchantAdditionProductAction $action
     * @return Renderable|RedirectResponse
     */
    public function update(UpdateMerchantAdditionProductRequest $request, UpdateMerchantAdditionProductAction $action): Renderable|RedirectResponse
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.additions-products.index', ['merchant_id' => $request->merchant_id]))->with(
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
     * Show the form to select the profile which will replace by the deleted Merchant Addition Product
     * @param DeleteAdditionProductRequest $request
     * @param DeleteAdditionProductAction $action
     * @return JsonResponse
     */
    public function delete(DeleteAdditionProductRequest $request, DeleteAdditionProductAction $action): JsonResponse
    {
        try {
            $action->handle($request);
            return response()->json([
                'status' => 'success',
                'message' => __('merchants::dashboard.the_merchant_addition_product_deleted'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Toggle the specified Merchant Addition Product
     * @param ToggleMerchanAdditionProductRequest $toggle_request
     * @param ToggleMerchantAdditionProductAction $action
     * @return JsonResponse
     */
    public function toggle(ToggleMerchanAdditionProductRequest $toggle_request, ToggleMerchantAdditionProductAction $action): JsonResponse
    {
        try {
            $action->handle($toggle_request);
            return response()->json([
                'status' => 'success',
                'message' => __('merchants::dashboard.the_merchant_working_hours_was_successfully'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

}
