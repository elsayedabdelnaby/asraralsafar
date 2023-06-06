<?php

namespace Modules\Website\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Website\Entities\TermCondition;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\TermsConditions\StoreTermConditionAction;
use Modules\Website\Actions\TermsConditions\DeleteTermConditionAction;
use Modules\Website\Actions\TermsConditions\ToggleTermConditionAction;
use Modules\Website\Actions\TermsConditions\UpdateTermConditionAction;
use Modules\Website\Actions\TermsConditions\GetAllTermsConditionsAction;
use Modules\Website\Http\Requests\TermsConditions\EditTermConditionRequest;
use Modules\Website\Http\Requests\TermsConditions\StoreTermConditionRequest;
use Modules\Website\Http\Requests\TermsConditions\DeleteTermConditionRequest;
use Modules\Website\Http\Requests\TermsConditions\ToggleTermConditionRequest;
use Modules\Website\Http\Requests\TermsConditions\UpdateTermConditionRequest;

class TermConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $terms_conditions = (new GetAllTermsConditionsAction)->handle();
            $total = count($terms_conditions);
            return [
                'data' => $terms_conditions,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('website::terms_conditions.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('website::terms_conditions.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.website.terms-conditions.store')
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreTermConditionRequest $request
     * @param StoreTermConditionAction $action
     * @return Renderable
     */
    public function store(StoreTermConditionRequest $request, StoreTermConditionAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/website/terms-conditions')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/terms-conditions')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified privacy policy.
     * @param ToggleTermConditionRequest $request
     * @param ToggleTermConditionAction $action
     * @param int $id
     * @return Renderable
     */
    public function toggle(ToggleTermConditionRequest $toggle_request, ToggleTermConditionAction $action, int $id)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('website::dashboard.the_term_condition_toggle_was_successfully'),
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
     * @param EditTermConditionRequest $request
     * @param int $id
     * @return Renderable
     */
    public function edit(EditTermConditionRequest $request, $id)
    {
        return view('website::terms_conditions.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.website.terms-conditions.update', ['id' => $id]),
                'term_condition' => TermCondition::find($id)
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateTermConditionRequest $request
     * @param UpdateTermConditionAction $action
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateTermConditionRequest $request, UpdateTermConditionAction $action, $id)
    {
        try {
            $action->handle($request, TermCondition::findOrFail($id));
            return redirect('dashboard/website/terms-conditions')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/terms-conditions')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteTermConditionRequest $request
     * @param DeleteTermConditionAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteTermConditionRequest $request, DeleteTermConditionAction $action, $id)
    {
        return $action->handle($request);
    }
}
