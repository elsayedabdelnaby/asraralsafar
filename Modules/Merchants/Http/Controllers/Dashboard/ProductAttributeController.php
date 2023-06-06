<?php

namespace Modules\Merchants\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use Modules\Merchants\Actions\ProductAttributes\GetProductAttributeOptions;
use Modules\Merchants\Actions\ProductAttributes\UpdateProductAttributeAction;
use Modules\Merchants\Entities\ProductAttribute;
use Modules\Merchants\Enums\ProductAttributeType;
use Modules\Merchants\Http\Requests\ProductAttribtues\EditProductAttributeRequest;
use Modules\Merchants\Http\Requests\ProductAttribtues\UpdateProductAttributeRequest;
use Modules\Settings\Actions\Categories\FilterCategoriesAction;
use Modules\Settings\Actions\Categories\FilterSubCategoriesAction;
use Modules\Merchants\Actions\ProductAttributes\StoreProductAttributeAction;
use Modules\Merchants\Actions\ProductAttributes\ToggleProductAttributeAction;
use Modules\Merchants\Actions\ProductAttributes\FilterProductAttributesAction;
use Modules\Merchants\Http\Requests\ProductAttribtues\StoreProductAttributeRequest;
use Modules\Merchants\Http\Requests\ProductAttribtues\ToggleProductAttributeRequest;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $product_attributes = (new FilterProductAttributesAction())->handle($request);
            $product_attributes = $product_attributes->select([
                "product_attributes.id",
                "product_attributes.input_type",
                "product_attribute_translations.name",
                "product_attributes.is_active",
                DB::raw('NULL AS actions'),

            ])->get();

            $total = count($product_attributes);

            return [
                "data"            => $product_attributes,
                'recordsTotal'    => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('merchants::product_attributes.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        return view('merchants::product_attributes.creating_editing.form')->with([
            'method'     => 'POST',
            'action'     => route('dashboard.products.product-attributes.store'),
            'categories' => $this->getCategories($request),
            'types'      => ProductAttributeType::cases()
        ]);
    }

    /*** Show the form for editing the specified resource.
     * @param EditProductAttributeRequest $request
     */
    public function edit(EditProductAttributeRequest $request)
    {
        return view('merchants::product_attributes.creating_editing.form')
            ->with([
                'method'=> 'PUT',
                'action'=> route('dashboard.products.product-attributes.update', ['id' => $request->id]),
                'categories' => $this->getCategories($request),
                'types'=> ProductAttributeType::cases(),
                'product_attribute'=>ProductAttribute::find($request->id),
                'product_attribute_options'=>(new GetProductAttributeOptions())->handle($request)
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateProductAttributeRequest $request
     * @param UpdateProductAttributeAction $action
     */
    public function update(UpdateProductAttributeRequest $request, UpdateProductAttributeAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.products.product-attributes.index'))->with(
                'success',
                __('dashboard.updated_successfully')
            );
        }
        catch (Exception $e) {
            return redirect(route('dashboard.products.product-attributes.index'))->with(
                'error',
                $e->getMessage()
            );
        }
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreProductAttributeRequest $request, StoreProductAttributeAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.products.product-attributes.index'))->with(
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

    /**
     * Toggle the specified State.
     * @param ToggleProductAttributeRequest $request
     * @param ToggleProductAttributeAction $action
     * @return Renderable
     */
    public function toggle(ToggleProductAttributeRequest $toggleRequest, ToggleProductAttributeAction $action)
    {
        try {
            $action->handle($toggleRequest);
            return response()->json([
                'status'  => 'success',
                'message' => __('merchants::dashboard.the_product_attribute_toggle_was_successfully'),
            ]);
        }
        catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    private function getCategories(Request|EditProductAttributeRequest $request)
    {
        $request->request->set('category_type_id', 1);
        $categories = (new FilterCategoriesAction)->handle($request)->select([
            'categories.id',
            'category_translations.name'
        ])->pluck('id')->toArray();

        $request->request->set('categories', implode(", ", $categories));
        $categories = (new FilterSubCategoriesAction)->handle($request)->select([
            'categories.id',
            'category_translations.name'
        ])->get();

        return $categories;
    }
}
