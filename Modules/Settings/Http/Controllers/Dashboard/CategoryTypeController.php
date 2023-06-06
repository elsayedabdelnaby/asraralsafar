<?php

namespace Modules\Settings\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Settings\Entities\CategoryType;
use Illuminate\Contracts\Support\Renderable;
use Modules\Settings\Actions\CategoryTypes\StoreCategoryTypeAction;
use Modules\Settings\Actions\CategoryTypes\DeleteCategoryTypeAction;
use Modules\Settings\Actions\CategoryTypes\FilterCategoryTypesAction;
use Modules\Settings\Actions\CategoryTypes\ToggleCategoryTypeAction;
use Modules\Settings\Actions\CategoryTypes\UpdateCategoryTypeAction;
use Modules\Settings\Actions\CategoryTypes\GetAllCategoryTypesAction;
use Modules\Settings\Http\Requests\CategoryTypes\EditCategoryTypeRequest;
use Modules\Settings\Http\Requests\CategoryTypes\StoreCategoryTypeRequest;
use Modules\Settings\Http\Requests\CategoryTypes\DeleteCategoryTypeRequest;
use Modules\Settings\Http\Requests\CategoryTypes\ToggleCategoryTypeRequest;
use Modules\Settings\Http\Requests\CategoryTypes\UpdateCategoryTypeRequest;

class CategoryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $category_types = (new GetAllCategoryTypesAction)->handle();
            $category_types = $category_types->select(
                'category_types.id',
                'name',
                'is_active',
                DB::raw('NULL AS actions')
            )->get();
            $total = count($category_types);
            return [
                'data' => $category_types,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('settings::category_types.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('settings::category_types.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.settings.category-types.store')
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCategoryTypeRequest $request
     * @param StoreCategoryTypeAction $action
     * @return Renderable
     */
    public function store(StoreCategoryTypeRequest $request, StoreCategoryTypeAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/settings/category-types')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/settings/category-types')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified footer section.
     * @param ToggleCategoryTypeRequest $request
     * @param ToggleCategoryTypeAction $action
     * @param int $id
     * @return Renderable
     */
    public function toggle(ToggleCategoryTypeRequest $toggle_request, ToggleCategoryTypeAction $action)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('settings::dashboard.the_category_type_toggle_was_successfully'),
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
     * @param EditCategoryTypeRequest $request
     * @return Renderable
     */
    public function edit(EditCategoryTypeRequest $request)
    {
        return view('settings::category_types.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.settings.category-types.update', ['id' => $request->id]),
                'category_type' => CategoryType::find($request->id)
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCategoryTypeRequest $request
     * @param UpdateCategoryTypeAction $action
     * @return Renderable
     */
    public function update(UpdateCategoryTypeRequest $request, UpdateCategoryTypeAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/settings/category-types')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/settings/category-types')->with(
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
    public function delete(int $id)
    {
        $category_types = (new FilterCategoryTypesAction([
            ['category_types.id', '<>', $id],
            ['category_types.is_active', true]
        ]))->handle();

        $category_types = $category_types->select(['category_types.id', 'category_type_translations.name'])->get();

        return response()->json([
            'status' => 'success',
            'html' => view('settings::category_types.deleting.form')
                ->with([
                    'item' => CategoryType::findOrFail($id),
                    'other_items' => $category_types,
                ])
                ->render(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteCategoryTypeRequest $request
     * @param DeleteCategoryTypeAction $action
     * @return Renderable
     */
    public function destroy(DeleteCategoryTypeRequest $request, DeleteCategoryTypeAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/settings/category-types')->with(
                'success',
                __('dashboard.deleted_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/settings/category-types')->with(
                'error',
                $e->getMessage()
            );
        }
    }
}
