<?php

namespace Modules\Website\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Modules\Website\Entities\FAQ;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\FAQs\StoreFAQAction;
use Modules\Website\Actions\FAQs\DeleteFAQAction;
use Modules\Website\Actions\FAQs\ToggleFAQAction;
use Modules\Website\Actions\FAQs\UpdateFAQAction;
use Modules\Website\Actions\FAQs\GetAllFAQsAction;
use Modules\Website\Http\Requests\FAQs\EditFAQRequest;
use Modules\Website\Http\Requests\FAQs\StoreFAQRequest;
use Modules\Website\Http\Requests\FAQs\DeleteFAQRequest;
use Modules\Website\Http\Requests\FAQs\ToggleFAQRequest;
use Modules\Website\Http\Requests\FAQs\UpdateFAQRequest;
use Modules\Settings\Actions\Categories\FilterCategoriesAction;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $faqs = (new GetAllFAQsAction)->handle();
            $faqs = $faqs->select([
                'faqs.id',
                'question',
                'answer',
                'display_order',
                'is_active',
                DB::raw('category_translations.name AS category_name'),
                DB::raw('NULL AS actions')
            ])->get();
            $total = count($faqs);
            return [
                'data' => $faqs,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('website::faqs.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        $request->request->add(['category_type_id' => 4, 'all' => true]);
        $categories = (new FilterCategoriesAction)->handle($request)->select(['categories.id', 'category_translations.name'])->get();
        return view('website::faqs.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.website.faqs.store'),
                'categories' => $categories
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreFAQRequest $request
     * @param StoreFAQAction $action
     * @return Renderable
     */
    public function store(StoreFAQRequest $request, StoreFAQAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/website/faqs')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/faqs')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified privacy policy.
     * @param ToggleFAQRequest $request
     * @param ToggleFAQAction $action
     * @param int $id
     * @return Renderable
     */
    public function toggle(ToggleFAQRequest $toggle_request, ToggleFAQAction $action)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('website::dashboard.the_faq_toggle_was_successfully'),
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
     * @param EditFAQRequest $request
     * @param int $id
     * @return Renderable
     */
    public function edit(EditFAQRequest $request)
    {
        $request->request->add(['category_type_id' => 4, 'all' => true]);
        return view('website::faqs.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.website.faqs.update', ['id' => $request->id]),
                'faq' => FAQ::find($request->id),
                'categories' => (new FilterCategoriesAction)->handle($request)->select(['categories.id', 'category_translations.name'])->get()
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateFAQRequest $request
     * @param UpdateFAQAction $action
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateFAQRequest $request, UpdateFAQAction $action)
    {
        try {
            $action->handle($request, FAQ::findOrFail($request->id));
            return redirect('dashboard/website/faqs')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/faqs')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteFAQRequest $request
     * @param DeleteFAQAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteFAQRequest $request, DeleteFAQAction $action)
    {
        return $action->handle($request);
    }
}
