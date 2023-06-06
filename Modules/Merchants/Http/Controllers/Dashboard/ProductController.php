<?php

namespace Modules\Merchants\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Merchants\Actions\Product\AcceptAdditionsToggleProductAction;
use Modules\Merchants\Actions\Product\DeleteProductAction;
use Modules\Merchants\Actions\Product\FilterProductAction;
use Modules\Merchants\Actions\Product\GetAllMerchantProductsAction;
use Modules\Merchants\Actions\Product\StoreProductAction;
use Modules\Merchants\Actions\Product\ToggleProductAction;
use Modules\Merchants\Actions\Product\UpdateMerchantProductAction;
use Modules\Merchants\Entities\Merchant;
use Modules\Merchants\Entities\Product;
use Modules\Merchants\Exports\ExportProductVariant;
use Modules\Merchants\Exports\ExportProductSimple;
use Modules\Merchants\Http\Requests\Product\AcceptAdditionsProductRequest;
use Modules\Merchants\Http\Requests\Product\CreateMerchantProductRequest;
use Modules\Merchants\Http\Requests\Product\DeleteProductRequest;
use Modules\Merchants\Http\Requests\Product\EditMerchantProductRequest;
use Modules\Merchants\Http\Requests\Product\GetAllCategoriesRequest;
use Modules\Merchants\Http\Requests\Product\GetAllMerchantProductsRequest;
use Modules\Merchants\Http\Requests\Product\StoreProductRequest;
use Modules\Merchants\Actions\ProductAttributes\ToggleProductAttributeAction;
use Modules\Merchants\Http\Requests\Product\ToggleProductRequest;
use Modules\Merchants\Http\Requests\Product\UpdateMerchantProductRequest;
use Modules\Merchants\Http\Requests\ProductAttribtues\ToggleProductAttributeRequest;
use Modules\Merchants\Imports\ProductImport;
use Modules\Merchants\Imports\ProductPriceUpdateImport;
use Modules\Settings\Actions\Categories\FilterCategoriesAction;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = (new FilterProductAction())->handle($request);
            $products = $products->select([
                "products.id",
                "product_translations.name",
                "products.type",
                "products.image",
                "products.price",
                "products.discount_price",
                "products.is_active",
                "products.accept_additions",
                DB::raw('NULL AS actions'),
            ])->get();

            $total = count($products);

            return [
                "data" => $products,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }

        $merchant = Merchant::find($request->merchant_id);

        return view('merchants::products.indexing.index', [
            'merchant' => $merchant
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(CreateMerchantProductRequest $request)
    {
        return view('merchants::products.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.merchants.products.store', ['merchant_id' => $request->merchant_id]),
                'merchant' => Merchant::find($request->merchant_id),
                'product_category_type' => $this->getProductCategoryType(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreProductRequest $request, StoreProductAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.products.index', ['merchant_id' => $request->merchant_id]))->with(
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


    /*** Show the form for editing the specified resource.
     * @param EditMerchantProductRequest $request
     * @return Renderable|View
     */
    public function edit(EditMerchantProductRequest $request): Renderable|View
    {
        return view('merchants::products.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.merchants.products.update', ['merchant_id' => $request->merchant_id, 'id' => $request->id]),
                'merchant' => Merchant::find($request->merchant_id),
                'merchant_product' => Product::find($request->id),
                'product_category_type' => $this->getProductCategoryType(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateMerchantProductRequest $request
     * @param UpdateMerchantProductAction $action
     * @return Renderable|RedirectResponse
     */
    public function update(UpdateMerchantProductRequest $request, UpdateMerchantProductAction $action): Renderable|RedirectResponse
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.products.index', ['merchant_id' => $request->merchant_id]))->with(
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
     * Toggle the specified State.
     * @param ToggleProductAttributeRequest $request
     * @param ToggleProductAttributeAction $action
     * @return Renderable
     */
    public function toggle(ToggleProductRequest $toggleRequest, ToggleProductAction $action)
    {
        try {
            $action->handle($toggleRequest);
            return response()->json([
                'status' => 'success',
                'message' => __('merchants::dashboard.the_product__toggle_was_successfully'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }


    /**
     * Toggle the specified State.
     * @param AcceptAdditionsProductRequest $request
     * @param AcceptAdditionsToggleProductAction $action
     * @return Renderable
     */
    public function acceptAdditions(AcceptAdditionsProductRequest $toggleRequest, AcceptAdditionsToggleProductAction $action)
    {
        try {
            $action->handle($toggleRequest);
            return response()->json([
                'status' => 'success',
                'message' => __('merchants::dashboard.the_product_accept_additions_toggle_was_successfully'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }


    /**
     * Show the form to select the profile which will replace by the deleted Merchant Addition Product
     * @param DeleteProductRequest $request
     * @param DeleteProductAction $action
     * @return JsonResponse
     */
    public function delete(DeleteProductRequest $request, DeleteProductAction $action): JsonResponse
    {
        try {
            $action->handle($request);
            return response()->json([
                'status' => 'success',
                'message' => __('merchants::dashboard.the_merchant_product_deleted'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /** Get All Product Category Type  **/
    private function getProductCategoryType($category_id = null)
    {
        $filterCategoriesAction = new Request();
        $filterCategoriesAction->merge(['category_type_id' => 1]);
        if (!is_null($category_id)) {
            $filterCategoriesAction->merge(['category_id' => $category_id]);
        }
        return (new FilterCategoriesAction())->handle($filterCategoriesAction)->select([
            'categories.id',
            'category_translations.name',
        ])->get();
    }

    public function getCategories(GetAllCategoriesRequest $request)
    {
        try {
            return response()->json([
                'status' => 200,
                'data' => $this->getProductCategoryType($request->get('category_type_id'))
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     *
     */
    public function getMerchantProducts(GetAllMerchantProductsRequest $request): JsonResponse
    {
        try {
            return response()->json([
                'status' => 200,
                'data' => (new GetAllMerchantProductsAction())->handle($request)
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function exportSimple($merchant_id): BinaryFileResponse
    {
        return Excel::download(new ExportProductSimple($merchant_id), 'products.xlsx');
    }

    public function exportVariant($merchant_id): BinaryFileResponse
    {
        return Excel::download(new ExportProductVariant($merchant_id), 'variants.xlsx');
    }

    public function importPrice(): RedirectResponse|Application|Redirector
    {
        try {
            Excel::import(new ProductPriceUpdateImport(), request()->file('product_price'));
            return redirect(route('dashboard.merchants.products.index', ['merchant_id' => request()->merchant_id]))->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (\Maatwebsite\Excel\Validators\ValidationException  $e) {
            return redirect(route('dashboard.merchants.products.index', ['merchant_id' => request()->merchant_id]))->with(
                'error',
                current($e->failures())->errors()[0],
            );
        }
    }

    public function importProduct(Request $request): RedirectResponse|Application|Redirector
    {
        try {
            Excel::import(new ProductImport($request->merchant_id), request()->file('product_simple'));
            return redirect(route('dashboard.merchants.products.index', ['merchant_id' => request()->merchant_id]))->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (\Maatwebsite\Excel\Validators\ValidationException  $e) {
            return redirect(route('dashboard.merchants.products.index', ['merchant_id' => request()->merchant_id]))->with(
                'error',
                current($e->failures())->errors()[0],
            );
        }
    }
}
