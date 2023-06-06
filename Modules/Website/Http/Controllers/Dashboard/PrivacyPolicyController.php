<?php

namespace Modules\Website\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Website\Entities\PrivacyPolicy;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\PrivacyPolicies\DeletePrivacyPolicyAction;
use Modules\Website\Actions\PrivacyPolicies\StorePrivacyPolicyAction;
use Modules\Website\Actions\PrivacyPolicies\TogglePrivacyPolicyAction;
use Modules\Website\Actions\PrivacyPolicies\UpdatePrivacyPolicyAction;
use Modules\Website\Actions\PrivacyPolicies\GetAllPrivacyPoliciesAction;
use Modules\Website\Http\Requests\PrivacyPolicies\DeletePrivacyPolicyRequest;
use Modules\Website\Http\Requests\PrivacyPolicies\EditPrivacyPolicyRequest;
use Modules\Website\Http\Requests\PrivacyPolicies\StorePrivacyPolicyRequest;
use Modules\Website\Http\Requests\PrivacyPolicies\TogglePrivacyPolicyRequest;
use Modules\Website\Http\Requests\PrivacyPolicies\UpdatePrivacyPolicyRequest;

class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $privacy_policies = (new GetAllPrivacyPoliciesAction)->handle();
            $total = count($privacy_policies);
            return [
                'data' => $privacy_policies,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('website::privacy_policies.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('website::privacy_policies.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.website.privacy-policies.store')
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StorePrivacyPolicyRequest $request
     * @param StorePrivacyPolicyAction $action
     * @return Renderable
     */
    public function store(StorePrivacyPolicyRequest $request, StorePrivacyPolicyAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/website/privacy-policies')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/privacy-policies')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified privacy policy.
     * @param TogglePrivacyPolicyRequest $request
     * @param TogglePrivacyPolicyAction $action
     * @param int $id
     * @return Renderable
     */
    public function toggle(TogglePrivacyPolicyRequest $toggle_request, TogglePrivacyPolicyAction $action, int $id)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('website::dashboard.the_privacy_policy_toggle_was_successfully'),
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
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('website::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param EditPrivacyPolicyRequest $request
     * @param int $id
     * @return Renderable
     */
    public function edit(EditPrivacyPolicyRequest $request, $id)
    {
        return view('website::privacy_policies.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.website.privacy-policies.update', ['id' => $id]),
                'privacy_policy' => PrivacyPolicy::find($id)
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdatePrivacyPolicyRequest $request
     * @param UpdatePrivacyPolicyAction $action
     * @param int $id
     * @return Renderable
     */
    public function update(UpdatePrivacyPolicyRequest $request, UpdatePrivacyPolicyAction $action, $id)
    {
        try {
            $action->handle($request, PrivacyPolicy::find($id));
            return redirect('dashboard/website/privacy-policies')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/privacy-policies')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeletePrivacyPolicyRequest $request
     * @param DeletePrivacyPolicyAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeletePrivacyPolicyRequest $request, DeletePrivacyPolicyAction $action, $id)
    {
        return $action->handle($request);
    }
}
