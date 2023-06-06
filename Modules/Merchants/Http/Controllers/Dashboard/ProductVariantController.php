<?php

namespace Modules\Merchants\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Merchants\Actions\Product\DeleteProductAction;
use Modules\Merchants\Actions\Product\ToggleProductAction;
use Modules\Merchants\Actions\ProductVariants\DeleteProductVariantAction;
use Modules\Merchants\Actions\ProductVariants\FilterProductVariantAction;
use Modules\Merchants\Actions\ProductVariants\GetAllProductAttributes;
use Modules\Merchants\Actions\ProductVariants\GetAttributeOptionsAction;
use Modules\Merchants\Actions\ProductVariants\StoreVariantsProductAction;
use Modules\Merchants\Actions\ProductVariants\ToggleProductVaraintAction;
use Modules\Merchants\Actions\ProductVariants\UpdateMerchantProductVariantAction;
use Modules\Merchants\Entities\Merchant;
use Modules\Merchants\Entities\Product;
use Modules\Merchants\Entities\ProductVariant;
use Modules\Merchants\Http\Requests\ProductAttribtues\CheckGetAttributeOptionsRequest;
use Modules\Merchants\Http\Requests\ProductVariants\CreateProductVariantRequest;
use Modules\Merchants\Http\Requests\ProductVariants\DeleteProductVariantRequest;
use Modules\Merchants\Http\Requests\ProductVariants\EditMerchantProductVariantRequest;
use Modules\Merchants\Http\Requests\ProductVariants\ListingProductVariantsRequest;
use Modules\Merchants\Http\Requests\ProductVariants\StoreProductVariantRequest;
use Modules\Merchants\Http\Requests\ProductVariants\ToggleProductVariantRequest;
use Modules\Merchants\Http\Requests\ProductVariants\UpdateMerchantProductVariantRequest;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ListingProductVariantsRequest $request)
    {
        if ($request->ajax()) {
            $productVariant = (new FilterProductVariantAction())->handle($request);
            $productVariant = $productVariant->select([
                'product_variants.id',
                'product_variants.price',
                'product_variants.is_active',
                DB::raw('NULL AS actions'),
            ])->get();

            $total = count($productVariant);

            return [
                "data"            => $productVariant,
                'recordsTotal'    => $total,
                'recordsFiltered' => $total,
            ];
        }

        $merchant = Merchant::find($request->merchant_id);
        $product  = Product::find($request->product_id);

        return view('merchants::product_variants.indexing.index', [
            'merchant' => $merchant,
            'product'  => $product
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(CreateProductVariantRequest $request)
    {
        return view('merchants::product_variants.creating_editing.form')
            ->with([
                'method'            => 'POST',
                'action'            => route('dashboard.merchants.products-variant.store', ['merchant_id' => $request->merchant_id, 'product_id' => $request->product_id]),
                'merchant'          => Merchant::find($request->merchant_id),
                'product'           => Product::find($request->product_id),
                'productAttributes' => (new GetAllProductAttributes())->handle()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreProductVariantRequest $request, StoreVariantsProductAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.products-variant.index', ['merchant_id' => $request->merchant_id,'product_id'=>$request->product_id]))->with(
                'success',
                __('dashboard.created_successfully')
            );
        }
        catch (Exception $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }


    /*** Show the form for editing the specified resource.
     * @param EditMerchantProductVariantRequest $request
     * @return Renderable|View
     */
    public function edit(EditMerchantProductVariantRequest $request): Renderable|View
    {
        return view('merchants::product_variants.creating_editing.form')
            ->with([
                'method'            => 'PUT',
                'action'            => route('dashboard.merchants.products-variant.update', ['merchant_id' => $request->merchant_id,'product_id'=>$request->product_id,'id' => $request->id]),
                'merchant'          => Merchant::find($request->merchant_id),
                'product'           => Product::find($request->product_id),
                'product_variant'   => ProductVariant::find($request->id),
                'productAttributes' => (new GetAllProductAttributes())->handle()
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateMerchantProductVariantRequest $request
     * @param UpdateMerchantProductVariantAction $action
     * @return Renderable|RedirectResponse
     */
    public function update(UpdateMerchantProductVariantRequest $request, UpdateMerchantProductVariantAction $action): Renderable|RedirectResponse
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.products-variant.index', ['merchant_id' => $request->merchant_id,'product_id'=>$request->product_id]))->with(
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
     * Toggle the specified State.
     * @param ToggleProductVariantRequest $request
     * @param ToggleProductAction $action
     * @return Renderable
     */
    public function toggle(ToggleProductVariantRequest $toggleRequest, ToggleProductVaraintAction $action)
    {
        try {
            $action->handle($toggleRequest);
            return response()->json([
                'status'  => 'success',
                'message' => __('merchants::dashboard.the_product_variant_toggle_was_successfully'),
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
     * Show the form to select the profile which will replace by the deleted Merchant Addition Product
     * @param DeleteProductVariantRequest $request
     * @param DeleteProductAction $action
     * @return JsonResponse
     */
    public function delete(DeleteProductVariantRequest $request, DeleteProductVariantAction $action): JsonResponse
    {
        try {
            $action->handle($request);
            return response()->json([
                'status'  => 'success',
                'message' => __('merchants::dashboard.the_merchant_product_variant_deleted'),
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
     * get Attribute Options
     * @param CheckGetAttributeOptionsRequest $request
     * @return void
     */
    public function getAttributeOptions(CheckGetAttributeOptionsRequest $request, GetAttributeOptionsAction $action)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data'   => $action->handle($request)
            ]);
        }
        catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
