<?php

namespace Modules\Settings\Http\Controllers\Dashboard;

use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Modules\Settings\Entities\Category;
use Modules\Settings\Actions\Categories\StoreCategoryAction;
use Modules\Settings\Actions\Categories\FilterCategoriesAction;
use Modules\Settings\Actions\Categories\UpdateCategoryAction;
use Modules\Settings\Http\Requests\SubCategories\EditSubCategoryRequest;
use Modules\Settings\Http\Requests\SubCategories\StoreSubCategoryRequest;
use Modules\Settings\Http\Requests\SubCategories\CreateSubCategoryRequest;
use Modules\Settings\Http\Requests\SubCategories\UpdateSubCategoryRequest;

class SubCategoryController extends Controller
{

    /**
     * @param Request $request
     * @param int $category_id
     * Display a listing of the resource.
     * @return mixed
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $subcategories_url = route('dashboard.settings.subcategories.index', ['category_id' => 'category_id']);
            $categories = (new FilterCategoriesAction)->handle($request);
            $categories = $categories->select([
                'categories.id',
                'category_translations.name',
                'category_type_translations.name as type',
                'slug',
                'is_active_in_mobile',
                'is_active_in_website',
                'parent_id',
                DB::raw("REPLACE('" . $subcategories_url . "', 'category_id', categories.id) AS subcategories"),
                DB::raw('NULL AS actions')
            ])->get();
            $total = count($categories);
            return [
                'data' => $categories,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        } else {
            $parent = Category::findOrFail($request->category_id);
            return view("settings::subcategories.indexing.index")->with(
                [
                    'category_id' => $parent->id,
                    'parent' => $parent
                ]
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     * @param CreateSubCategoryRequest $request
     * @return View
     */
    public function create(CreateSubCategoryRequest $request)
    {
        return view('settings::subcategories.creating_editing.form')->with([
            'method' => 'POST',
            'action' => route('dashboard.settings.subcategories.store', ['category_id' => $request->category_id]),
            'category_id' => $request->category_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreSubCategoryRequest $request
     * @param StoreCategoryAction $action
     * @return RedirectResponse
     */
    public function store(StoreSubCategoryRequest $request, StoreCategoryAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/settings/categories/' . $request->category_id . '/subcategories')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/settings/categories/' . $request->category_id . '/subcategories')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param EditSubCategoryRequest $request
     * @return Renderable
     */
    public function edit(EditSubCategoryRequest $request)
    {
        return view('settings::subcategories.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.settings.subcategories.update', ['category_id' => $request->category_id, 'id' => $request->id]),
                'subcategory' => Category::find($request->id),
                'category_id' => $request->category_id
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateSubCategoryRequest $request
     * @param UpdateCategoryAction $action
     * @return Renderable
     */
    public function update(UpdateSubCategoryRequest $request, UpdateCategoryAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/settings/categories/' . $request->category_id . '/subcategories')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/settings/categories/' . $request->category_id . '/subcategories')->with(
                'error',
                $e->getMessage()
            );
        }
    }
}
