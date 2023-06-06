<?php

namespace Modules\Settings\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Settings\Entities\Category;
use Illuminate\Contracts\Support\Renderable;
use Modules\Settings\Exports\ExportCategory;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Modules\Settings\Actions\Categories\StoreCategoryAction;
use Modules\Settings\Actions\Categories\DeleteCategoryAction;
use Modules\Settings\Actions\Categories\ToggleCategoryAction;
use Modules\Settings\Actions\Categories\UpdateCategoryAction;
use Modules\Settings\Actions\Categories\FilterCategoriesAction;
use Modules\Settings\Http\Requests\Categories\EditCategoryRequest;
use Modules\Settings\Http\Requests\Categories\StoreCategoryRequest;
use Modules\Settings\Http\Requests\Categories\DeleteCategoryRequest;
use Modules\Settings\Http\Requests\Categories\ToggleCategoryRequest;
use Modules\Settings\Http\Requests\Categories\UpdateCategoryRequest;
use Modules\Settings\Actions\CategoryTypes\GetAllCategoryTypesAction;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
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
                DB::raw("REPLACE('" . $subcategories_url . "', 'category_id', categories.id) AS subcategories"),
                DB::raw('NULL AS actions')
            ])->get();
            $total = count($categories);
            return [
                'data' => $categories,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('settings::categories.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('settings::categories.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.settings.categories.store'),
                'category_types' => (new GetAllCategoryTypesAction)->handle()->active()->select('category_types.id', 'name')->get()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCategoryRequest $request
     * @param StoreCategoryAction $action
     * @return Renderable
     */
    public function store(StoreCategoryRequest $request, StoreCategoryAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/settings/categories')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/settings/categories')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified category.
     * @param ToggleCategoryRequest $request
     * @param ToggleCategoryAction $action
     * @return Renderable
     */
    public function toggle(ToggleCategoryRequest $toggle_request, ToggleCategoryAction $action)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('settings::dashboard.the_category_toggle_was_successfully'),
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ]
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param EditCategoryRequest $request
     * @return Renderable
     */
    public function edit(EditCategoryRequest $request)
    {
        return view('settings::categories.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.settings.categories.update', ['id' => $request->id]),
                'category' => Category::find($request->id),
                'category_types' => (new GetAllCategoryTypesAction)->handle()->active()->select('category_types.id', 'name')->get()
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCategoryRequest $request
     * @param UpdateCategoryAction $action
     * @return Renderable
     */
    public function update(UpdateCategoryRequest $request, UpdateCategoryAction $action)
    {
        try {
            $action->handle($request, Category::find($request->id));
            return redirect('dashboard/settings/categories')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/settings/categories')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Show the form to select the profile which will replace by the deleted profile
     * @param int $id
     * @return Renderable
     */
    public function delete(Request $request, int $id)
    {
        $category = Category::findOrFail($id);
        $conditions = [
            ['categories.id', '<>', $id],
            ['categories.category_type_id', $category->category_type_id]
        ];

        if ($category->parent_id) {
            $request->request->add(['category_id' => $category->parent_id]);
        }

        $categories = (new FilterCategoriesAction())->handle($request, $conditions)
            ->select(['categories.id', 'category_translations.name'])->get();

        return response()->json([
            'status' => 'success',
            'html' => view('settings::categories.deleting.form')
                ->with([
                    'item' => $category,
                    'other_items' => $categories,
                ])
                ->render(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteCategoryRequest $request
     * @param DeleteCategoryAction $action
     * @return Renderable
     */
    public function destroy(DeleteCategoryRequest $request, DeleteCategoryAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/settings/categories')->with(
                'success',
                __('dashboard.deleted_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/settings/categories')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function export(): BinaryFileResponse
    {
        return Excel::download(new ExportCategory, 'categories.xlsx');
    }
}
